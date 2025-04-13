<?php

namespace App\Http\Controllers;

use App\Models\Fuel_record;
use App\Models\Report;
use App\Models\Route;
use App\Models\Trailer;
use App\Models\Vehicle;
use App\Models\Driver;
use App\Models\Expenses;
use App\Models\Expenses_Caterogry;
use App\Models\Maintenance_task;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return Inertia::render('Report/Route',[
            'tractor' => Vehicle::orderBy('created_at', 'desc')->get(['license_plate']),
            'driver' => Driver::selectRaw("CONCAT(first_name, ' ', last_name) AS full_name")
            ->orderBy('created_at', 'desc')
            ->get()
        ]);
    }

    public function routefilter(Request $request)
    {

        $query = Route::with(['vehicle', 'trailer', 'startLocation', 'endLocation', 'driver']);

        // Filter by date range
        if ($request->start_date && $request->end_date) {
            $query->whereBetween('routes.start_date', [$request->start_date, $request->end_date]);
        }

        // Filter by driver name
        if ($request->driver) {
            $query->whereHas('driver', function ($q) use ($request) {
                $q->whereRaw("CONCAT(first_name, ' ', last_name) = ?", [$request->driver]);
            });
        }

        // Filter by vehicle plate number
        if ($request->vehicle) {
            $query->whereHas('vehicle', function ($q) use ($request) {
                $q->where('license_plate', $request->vehicle);
            });
        }

        $routes = $query->get();

        return Inertia::render('Report/Route', [
            'routes' => $routes,
            'filters' => $request->all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function reportfuel()
    {

        return Inertia::render('Report/Fuel',[
            'tractor' => Vehicle::orderBy('created_at', 'desc')->get(['license_plate']),
            'driver' => Driver::orderBy('created_at', 'desc')
            ->select(DB::raw("CONCAT(first_name, ' ', last_name) as full_name"), 'id')
            ->get(),
        ]);
    }

    public function filterFuelReports(Request $request)
    {

        $query = Fuel_record::with(['vehicle','driver']);

        if ($request->start_date && $request->end_date) {
            $query->whereBetween('refueling_date', [$request->start_date, $request->end_date]);
        }

        if ($request->driver && isset($request->driver['full_name'])) {
            $fullName = strtolower(trim($request->driver['full_name']));
            $query->whereHas('driver', function ($q) use ($fullName) {
                $q->whereRaw("LOWER(TRIM(CONCAT(first_name, ' ', last_name))) = ?", [$fullName]);
            });
        }

        if ($request->vehicle) {
            $query->whereHas('vehicle', function ($q) use ($request) {
                $q->where('license_plate', $request->vehicle);
            });
        }

        if ($request->liters) {
            $query->where('total_refuel', '>=', $request->liters);
        }

        if ($request->min_cost) {
            $query->where('amount', '>=', $request->min_cost);
        }

        if ($request->max_cost) {
            $query->where('amount', '<=', $request->max_cost);
        }

        return Inertia::render('Report/Fuel', [
            'fuelFilter' => $query->get(),
        ]);
    }

    public function reportmaintenance()
    {
        return Inertia::render('Report/Maintenance',[
            'tractor' => Vehicle::orderBy('created_at', 'desc')->get(['license_plate']),
            'trailer' => Trailer::orderBy('created_at', 'desc')->get(['license_plate'])
        ]);

    }

    public function filterMaintenanceReports(Request $request)
    {


        $query = Maintenance_task::with(['vehicle', 'trailer']);

        if ($request->start_date && $request->end_date) {
            $query->whereBetween('created_at', [$request->start_date, $request->end_date]);
        }


        if ($request->vehicle) {
            $query->whereHas('vehicle', function ($q) use ($request) {
                $q->where('license_plate', $request->vehicle);
            });
        }

        if ($request->trailer) {
            $query->whereHas('trailer', function ($q) use ($request) {
                $q->where('license_plate', $request->trailer);
            });
        }

        if ($request->supplier) {
            $query->where('supplier', 'like', '%' . $request->supplier . '%');
        }

        if ($request->min_cost) {
            $query->where('total', '>=', $request->min_cost);
        }

        if ($request->max_cost) {
            $query->where('total', '<=', $request->max_cost);
        }

        return Inertia::render('Report/Maintenance', [
            'maintenanceFilter' => $query->get(),
        ]);

    }


    /**
     * Store a newly created resource in storage.
     */
    public function reportexpenses(Request $request)
    {
        return Inertia::render('Report/Expenses',[
            'tractor' => Vehicle::orderBy('created_at', 'desc')->get(['license_plate']),
            'trailer' => Trailer::orderBy('created_at', 'desc')->get(['license_plate']),
            'category' => Expenses_Caterogry::orderBy('created_at', 'desc')->get(),
        ]);
    }

    /**
     * Display the specified resource.
     */


     public function filterExpensesReports(Request $request)
        {
        $query = Expenses::with(['tractor', 'trailer', 'category']);

        // Convert date formats
        $startDate = Carbon::parse($request->start_date)->format('Y-m-d H:i:s');
        $endDate = Carbon::parse($request->end_date)->format('Y-m-d H:i:s');
        $query->whereBetween('expense_date', [$startDate, $endDate]);

        // Fix Trailer Filtering (Join with trailers table)
        if (!empty($request->trailer['license_plate'])) {
            $query->whereHas('trailer', function ($q) use ($request) {
                $q->where('license_plate', $request->trailer['license_plate']);
            });
        }

        // Fix Category Filtering
        if (!empty($request->categoryId)) {
            $query->where('category_id', $request->categoryId);
        }

        // Fix Cost Filtering
        if (!empty($request->min_cost)) {
            $query->where('amount', '>=', $request->min_cost);
        }

        if (!empty($request->max_cost)) {
            $query->where('amount', '<=', $request->max_cost);
        }

        // Debug: Show SQL Query


        return Inertia::render('Report/Expenses', [
            'expensesFilter' => $query->get(),
        ]);
    }

    public function downloadPdfRoute(Request $request)
    {
        $routes = $request->input('routes'); // array of routes

        $pdf = Pdf::loadView('pdf.route-report', ['routes' => $routes]);

        return $pdf->download('route_report.pdf');
    }

    public function downloadPdfFuel(Request $request)
    {
        $fuels = $request->input('fuels'); // array of routes

        $pdf = Pdf::loadView('pdf.fuel-report', ['fuels' => $fuels]);

        return $pdf->download('fuel_report.pdf');
    }

    public function downloadPdfMaintenance(Request $request)
    {

        $maintenance = $request->input('maintenance'); // array of routes

        $pdf = Pdf::loadView('pdf.maintenance-report', ['maintenance' => $maintenance])
                    ->setPaper('a4', 'landscape'); // <-- set to landscape
        return $pdf->download('maintenance_report.pdf');
    }


}

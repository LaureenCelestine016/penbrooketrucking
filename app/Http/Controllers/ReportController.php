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
        ]);
    }

    public function filterFuelReports(Request $request)
    {

        $query = Fuel_record::with(['vehicle']);

        if ($request->start_date && $request->end_date) {
            $query->whereBetween('refueling_date', [$request->start_date, $request->end_date]);
        }


        if ($request->vehicle) {
            $query->whereHas('vehicle', function ($q) use ($request) {
                $q->where('license_plate', $request->vehicle);
            });
        }

        if ($request->liters) {
            $query->where('liters', '>=', $request->liters);
        }

        if ($request->min_cost) {
            $query->where('cost', '>=', $request->min_cost);
        }

        if ($request->max_cost) {
            $query->where('cost', '<=', $request->max_cost);
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
                $q->where('license_plate', $request->vehicle);
            });
        }

        if ($request->supplier) {
            $query->where('supplier', 'like', '%' . $request->supplier . '%');
        }

        if ($request->min_cost) {
            $query->where('price', '>=', $request->min_cost);
        }

        if ($request->max_cost) {
            $query->where('price', '<=', $request->max_cost);
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

    public function show(Report $report)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Report $report)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Report $report)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Report $report)
    {
        //
    }
}

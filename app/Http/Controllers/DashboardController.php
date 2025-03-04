<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\Trailer;
use App\Models\Driver;
use App\Models\Expenses;
use App\Models\Fuel_record;
use App\Models\Maintenance_task;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;


class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $truck = Vehicle::count();

        $driver = Driver::count();

        $fuelTotal = Fuel_record::sum('cost');

        $maintenanceTotal = Maintenance_task::sum('total');

        $operationalCount = Vehicle::where('status', 'Operational')->count();

        $nonOperationalCount = Vehicle::where('status',  'Non-Operational')->count();

        $maintenance = Vehicle::where('status', 'Maintenance')->count();

        $fuelConsumption = Vehicle::with('fuelRecords')
        ->get()
        ->map(function ($vehicle) {
            return [
                'name' => $vehicle->model, // Change to your actual vehicle name column
                'total_fuel' => $vehicle->fuelRecords->sum('liters'),
                'total_cost' => $vehicle->fuelRecords->sum('cost'),
            ];
        });

        $maintenanceCosts = [
            'vehicles' => Vehicle::with('maintenanceTasks')
                ->get()
                ->map(function ($vehicle) {
                    return [
                        'name' => $vehicle->model, // Change this to your actual column name
                        'total_cost' => $vehicle->maintenanceTasks->sum('total'),
                    ];
                }),

            'trailers' => Trailer::with('maintenanceTasks')
                ->get()
                ->map(function ($trailer) {
                    return [
                        'name' => $trailer->license_plate,
                        'total_cost' => $trailer->maintenanceTasks->sum('total'),
                    ];
                }),
        ];

        $monthlyExpenses = Expenses::with('category') // Load category relationship
        ->select(
            DB::raw("DATE_FORMAT(expense_date, '%Y-%m') as month"),
            'category_id',
            DB::raw("SUM(amount) as total_cost")
        )
        ->groupBy('month', 'category_id')
        ->orderBy('month', 'ASC')
        ->get()
        ->map(function ($expense) {
            return [
                'month' => $expense->month,
                'category_id' => $expense->category_id,
                'category_name' => $expense->category->name, // Get category name from relationship
                'total_cost' => $expense->total_cost,
            ];
        });



        return Inertia::render('Dashboard', [
            'truck' => $truck,
            'driver' => $driver,
            'fuelTotal' => $fuelTotal,
            'maintenanceTotal' => $maintenanceTotal,
            'operationalCount' => $operationalCount,
            'nonOperationalCount' => $nonOperationalCount,
            'maintenance' => $maintenance,
            'fuelConsumption' => $fuelConsumption,
            'vehicleMaintenanceCosts' => $maintenanceCosts

        ]);



    }




}

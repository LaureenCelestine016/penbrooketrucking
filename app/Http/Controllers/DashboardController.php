<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\Route; // Your routes table model
use App\Models\Notification;
use App\Models\Maintenance_task;
use App\Models\Fuel_record;
use App\Models\Trailer;
use App\Models\Driver;
use App\Models\Expenses;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{


    public function index() {

        $user = Auth::user();

            if($user->user_type == 1) {
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
                    'vehicleMaintenanceCosts' => $maintenanceCosts,
                    'monthlyExpenses' => $monthlyExpenses
                ]);

            } else {
                $driverId = $user->driver_id;

                $assignedRides = Route::where('driver_id', $driverId)->count();
                $ongoingRides = Route::where('driver_id', $driverId)
                    ->where('status', 'Ongoing')
                    ->count();
                $completedRides = Route::where('driver_id', $driverId)
                    ->where('status', 'Completed')
                    ->count();
                $nextRide = Route::with('startLocation','endLocation')->where('driver_id', $driverId)
                    ->where('status', 'Yet to start')
                    ->orderBy('start_date', 'asc')
                    ->first();



                $pendingNotifications = Notification::where('driver_id', $driverId)
                    ->where('status', 'pending')
                    ->count();

                return Inertia::render('Dashboard', [
                    'assignedRides'       => $assignedRides,
                    'ongoingRides'        => $ongoingRides,
                    'completedRides'      => $completedRides,
                    'nextRide'            => $nextRide ,
                    'pendingNotifications'=> $pendingNotifications,
                ]);

            }
        }



}

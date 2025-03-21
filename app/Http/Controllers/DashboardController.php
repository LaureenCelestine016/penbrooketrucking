<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\Route; // Your routes table model
use App\Models\Notification;
use App\Models\Maintenance_task;
use App\Models\Fuel_record;
use App\Models\Trailer;
use App\Models\User;
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
                $trucks = collect([Vehicle::class, Trailer::class])
                ->sum(fn($model) => $model::count());

                $operationalCount = collect([Vehicle::class, Trailer::class])
                ->sum(fn($model) => $model::where('status', 'Operational')->count());

                $nonOperationalCount = collect([Vehicle::class, Trailer::class])
                ->sum(fn($model) => $model::where('status', 'Non-Operational')->count());

                $maintenance = collect([Vehicle::class, Trailer::class])
                ->sum(fn($model) => $model::where('status', 'Maintenance')->count());

                $driver = Driver::count();

                $fuelTotal = Fuel_record::sum('cost');

                $maintenanceTotal = Maintenance_task::sum('total');

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

                $notifications = Notification::with('vehicle','trailer' )->where('status', 'pending')->orderBy('reported_at', 'desc')->get();

                $drivers = User::where('user_type', 0)->get();

                return Inertia::render('Dashboard', [
                    'truck' => $trucks,
                    'driver' => $driver,
                    'fuelTotal' => $fuelTotal,
                    'maintenanceTotal' => $maintenanceTotal,
                    'operationalCount' => $operationalCount,
                    'nonOperationalCount' => $nonOperationalCount,
                    'maintenance' => $maintenance,
                    'fuelConsumption' => $fuelConsumption,
                    'vehicleMaintenanceCosts' => $maintenanceCosts,
                    'monthlyExpenses' => $monthlyExpenses,
                    'notification' => $notifications,
                    'drivers'  => $drivers
                ]);

            } else {
                $driverId = $user->driver_id;

                $assignedRides = Route::where('driver_id', $driverId)->where('status', 'Yet to start')->count();
                $ongoingRides = Route::where('driver_id', $driverId)
                    ->where('status', 'Ongoing')
                    ->count();
                $completedRides = Route::where('driver_id', $driverId)
                    ->where('status', 'Completed')
                    ->count();
                $cancelledRide = Route::with('startLocation','endLocation')->where('driver_id', $driverId)
                    ->where('status', 'Cancelled')->count();

                $driverTruckUsed = Route::with('vehicle', 'trailer', 'startLocation', 'endLocation')
                    ->where('driver_id', $driverId)->where('status','Completed') // Filter by driver_id
                    ->get();

                // $pendingNotifications = Notification::where('driver_id', $driverId)
                //     ->where('status', 'pending')
                //     ->count();

                return Inertia::render('Dashboard', [
                    'assignedRides'       => $assignedRides,
                    'ongoingRides'        => $ongoingRides,
                    'completedRides'      => $completedRides,
                    'cancelledRide'       => $cancelledRide ,
                    'driverTruckUsed'     => $driverTruckUsed
                    // 'pendingNotifications'=> $pendingNotifications,
                ]);

            }
        }

    }


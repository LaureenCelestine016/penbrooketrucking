<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\Route; // Your routes table model
use App\Models\Notification;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display the dashboard.
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->user_type == 1) {
            // Admin dashboard data
            $truck = Vehicle::count();
            $operationalCount = Vehicle::where('status', 'Operational')->count();
            $nonOperationalCount = Vehicle::where('status', 'Non-Operational')->count();
            $maintenance = Vehicle::where('status', 'Maintenance')->count();

            $fuelConsumption = Vehicle::with('fuelRecords')
                ->get()
                ->map(function ($vehicle) {
                    return [
                        'name'       => $vehicle->name, // Adjust to your actual vehicle name column
                        'total_fuel' => $vehicle->fuelRecords->sum('liters'),
                        'total_cost' => $vehicle->fuelRecords->sum('cost'),
                    ];
                });

            return Inertia::render('Dashboard', [
                'truck'              => $truck,
                'operationalCount'   => $operationalCount,
                'nonOperationalCount'=> $nonOperationalCount,
                'maintenance'        => $maintenance,
                'fuelConsumption'    => $fuelConsumption,
            ]);
        } else {
            // Driver dashboard data
            $driverId = $user->driver_id; // Ensure your users table holds the driver_id for drivers

            $assignedRides = Route::where('driver_id', $driverId)->count();
            $ongoingRides = Route::where('driver_id', $driverId)
                ->where('status', 'Ongoing')
                ->count();
            $completedRides = Route::where('driver_id', $driverId)
                ->where('status', 'Completed')
                ->count();
            $nextRide = Route::where('driver_id', $driverId)
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
                'nextRide'            => $nextRide ? [
                    'start_date'    => $nextRide->start_date->format('M d, Y'),
                    'start_location'=> $nextRide->start_location_id, // You can join with locations for more detail
                    'end_location'  => $nextRide->end_location_id,
                ] : null,
                'pendingNotifications'=> $pendingNotifications,
            ]);
        }
    }
}

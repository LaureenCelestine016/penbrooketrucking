<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $truck = Vehicle::count();
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



        return Inertia::render('Dashboard', [
            'truck' => $truck,
            'operationalCount' => $operationalCount,
            'nonOperationalCount' => $nonOperationalCount,
            'maintenance' => $maintenance,
            'fuelConsumption' => $fuelConsumption
        ]);



    }




}

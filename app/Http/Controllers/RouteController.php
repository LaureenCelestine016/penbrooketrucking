<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Models\Location;
use App\Models\Route;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Carbon\Carbon;

class RouteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return Inertia::render('Route/Index',[
            "route" => Route::with("vehicle","driver","startLocation", "endLocation")->get(),
            "drivers" => Driver::selectRaw("id, CONCAT(first_name, ' ', last_name) AS fullname")
                ->orderBy('created_at', 'desc')
                ->get(),

            ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return Inertia::render('Route/Create', [
            "vehicles" => Vehicle::with(['fuelRecords' => function ($query) {
                $query->orderBy('created_at', 'desc');
            }])
            ->where('status', 'active')
            ->orderBy('created_at', 'desc')
            ->get(['id', 'name']),

            "locations" => Location::get(['id', 'address']),

            "drivers" => Driver::selectRaw("id, CONCAT(first_name, ' ', last_name) AS fullname")
                ->orderBy('created_at', 'desc')
                ->get(),
        ]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'vehicleId'         => 'required|integer|exists:vehicles,id', // Ensure vehicleId is valid and exists in the vehicles table
            'driverId'          => 'required|integer|exists:drivers,id', // Ensure driverId is valid and exists in the drivers table
            'startLocId'        => 'required|integer|exists:locations,id', // Ensure start location exists
            'endLocId'          => 'required|integer|exists:locations,id', // Ensure end location exists
            'fuelId'            => 'required|integer|exists:fuel_records,id', // Ensure fuel type exists
            'dateStart'         => 'required|date|after:today', // Ensure dateStart is a valid date and is after today
            'dateEnd'           => 'required|date|after:dateStart', // Ensure dateEnd is a valid date and after dateStart
            'status'            => 'required|string', // Ensure status is a string
            'aproxKM'           => 'required|numeric|min:0', // Ensure aproxKM is a number and greater than or equal to 0

        ]);

        $validatedData['dateStart'] = Carbon::parse($validatedData['dateStart'])->format('Y-m-d H:i:s');
        $validatedData['dateEnd'] = Carbon::parse($validatedData['dateEnd'])->format('Y-m-d H:i:s');

        Route::create([
            'vehicle_id'                 => $validatedData['vehicleId'],
            'driver_id'                  => $validatedData['driverId'],
            'start_location_id'          => $validatedData['startLocId'],
            'end_location_id'            => $validatedData['endLocId'],
            'fuel_id'                    => $validatedData['fuelId'],
            'start_date'                 => $validatedData['dateStart'],
            'end_date'                   => $validatedData['dateEnd'],
            'distance_km'                => $validatedData['aproxKM'],
            'status'                     => $validatedData['status'],

        ]);

        return redirect()->route('route')->with('success', 'Route created successfully!');

    }

    /**
     * Display the specified resource.
     */
    public function show(Route $route)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Route $route)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Route $route)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Route $route)
    {
        //
    }
}

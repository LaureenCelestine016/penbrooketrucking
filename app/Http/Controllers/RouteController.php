<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Models\Fuel_record;
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
            "route" => Route::with("vehicle","driver","startLocation", "endLocation")->orderBy('created_at', 'desc')->get(),
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
                $query->where('is_used', 0) // Filter only unused fuel records
                      ->orderBy('created_at', 'desc');
            }])
            ->where('status', 'Operational')
            ->orderBy('created_at', 'desc')
            ->get(['id', 'name']),

            "locations" => Location::get(['id', 'address', 'latitude', 'longitude']),

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
            'vehicleId'         => 'required|integer|exists:vehicles,id',
            'driverId'          => 'required|integer|exists:drivers,id',
            'startLocId'        => 'required|integer|exists:locations,id',
            'endLocId'          => 'required|integer|exists:locations,id',
            'fuelId'            => 'required|integer|exists:fuel_records,id',
            'dateStart'         => 'required|date|after:today',
            'dateEnd'           => 'required|date|after:dateStart',
            'status'            => 'required|string',
            'aproxKM'           => 'required|numeric|min:0',

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

        $fuel = Fuel_record::find($request->fuelId);
        $fuel->is_used = 1;
        $fuel->save();

        return redirect()->route('route')->with('success', 'Route created successfully!');

    }

    /**
     * Display the specified resource.
     */
    public function show(Route $route)
    {
        // Load related models
        $route->load(['vehicle', 'driver', 'startLocation', 'endLocation']);

        // Format data (optional, based on what you need)
        $routeData = [
            'id' => $route->id,
            'vehicle' => $route->vehicle,
            'driver' => [
                'id' => $route->driver->id,
                'fullname' => $route->driver->first_name . ' ' . $route->driver->last_name
            ],
            'start_location' => $route->startLocation,
            'end_location' => $route->endLocation,
            'start_date' => $route->start_date,
            'end_date' => $route->end_date,
            'distance_km' => $route->distance_km,
            'status' => $route->status,
        ];

        $driver = Driver::selectRaw("id, CONCAT(first_name, ' ', last_name) AS fullname")
        ->orderBy('created_at', 'desc')
        ->get();

        return Inertia::render('Route/Show', [
            "route" => $routeData,
            "driver" => $driver,
        ]);
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

        $validatedData = $request->validate([
            'driver.id'   => 'required|integer|exists:drivers,id',
            'start_date' => 'required|date',
            'end_date'   => 'required|date',
            'status'     => 'required|string',
        ]);

        $validatedData['driver_id'] = $validatedData['driver']['id'];
        $validatedData['start_date'] = Carbon::parse($validatedData['start_date'])->format('Y-m-d  H:i:s' );
        $validatedData['end_date'] = Carbon::parse($validatedData['end_date'])->format('Y-m-d  H:i:s');

        $route->update($validatedData);

        return redirect()->route('route.show', $route);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Route $route)
    {
        $route->delete();
        return redirect()->route('route');
    }

    public function deletedAll(Request $request)
    {
        $ids = $request->ids;
        Route::whereIn('id', $ids)->delete();

        return redirect()->route('route');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Resources\VehicleResource;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vehicles = VehicleResource::Collection(Vehicle::all());

        return Inertia::render('Vehicle/Index', ['vehicles' => $vehicles]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Vehicle/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'registrationNumber' => ['required', 'string', 'max:255'],
            'vehicleName' => ['required', 'string', 'max:255'],
            'vehicleType' => ['required', 'string', 'max:255'],
            'model' => ['required', 'string', 'max:255'],
            'plateNumber' => ['required', 'string', 'max:10'],
            'chassisNumber' => ['required', 'string', 'max:10'],
            'engineNumber' => ['required', 'string', 'max:10'],
            'manufacture' => ['required', 'string', 'max:10'],
            'manufactureYear' => ['required', 'string', 'max:10'],
            'status' => ['required', 'string', 'max:10'],
            'registrationDate' => ['required', 'string', 'max:10'],
            'registrationExp' => ['required', 'string', 'max:10'],

        ]);
        dd($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(Vehicle $vehicle)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vehicle $vehicle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vehicle $vehicle)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vehicle $vehicle)
    {
        $vehicle->delete();

        return redirect()->route('vehicle');
    }

    public function deletedAll(Request $request)
    {
        $ids = $request->ids;
        Vehicle::whereIn('id', $ids)->delete();

        return redirect()->route('vehicle');
    }

}

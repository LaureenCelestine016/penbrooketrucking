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
        $vehicles = VehicleResource::collection(
            Vehicle::orderBy('created_at', 'desc')->get()
        );

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
    // Validate the incoming request

    $validatedData = $request->validate([
        'registrationNumber'           => 'required|string|max:255',
        'vehicleName'                  => 'required|string|max:255',
        'vehicleType'                  => 'required|string|max:255',
        'model'                        => 'required|string|max:255',
        'plateNumber'                  => 'required|string|max:10',
        'chassisNumber'                => 'required|string|max:255',
        'engineNumber'                 => 'required|string|max:10',
        'manufacture'                  => 'required|string|max:255',
        'manufactureYear'              => 'required|string|max:10',
        'status'                       => 'required|string|max:10',
        'registrationDate'             => 'required|string|max:10',
        'registrationExp'              => 'required|string|max:10',
    ]);

    // Create and save a new vehicle record
    Vehicle::create([
        'name'                         => $validatedData['vehicleName'],
        'type'                         => $validatedData['vehicleType'],
        'model'                        => $validatedData['model'],
        'status'                       => $validatedData['status'],
        'chassis_number'               => $validatedData['chassisNumber'],
        'license_plate'                => $validatedData['plateNumber'],
        'engine_number'                => $validatedData['engineNumber'],
        'manufacturer'                 => $validatedData['manufacture'],
        'manufacture_year'             => $validatedData['manufactureYear'],
        'registration_number'          => $validatedData['registrationNumber'],
        'registration_date'            => $validatedData['registrationDate'],
        'registration_expiration_date' => $validatedData['registrationExp'],
    ]);

    // Redirect to the vehicle route
    return redirect()->route('vehicle')->with('success', 'Vehicle created successfully!');

    }


    public function upload(Request $request)
    {


        $request->validate([
            'files.*' => 'required|file|mimes:jpeg,png,jpg,gif|max:1024', // Max 1MB per file
        ]);
    }


    /**
     * Display the specified resource.
     */
    public function show(Vehicle $vehicle)
    {

        return Inertia::render('Vehicle/Show', ["Vehicle" => $vehicle]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vehicle $vehicle)
    {

        $validatedData = $request->validate([
            'registration_number'           => 'required|string|max:255',
            'name'                          => 'required|string|max:255',
            'type'                          => 'required|string|max:255',
            'model'                         => 'required|string|max:255',
            'license_plate'                 => 'required|string|max:10',
            'chassis_number'                => 'required|string|max:255',
            'engine_number'                 => 'required|string|max:10',
            'manufacturer'                  => 'required|string|max:255',
            'manufacture_year'              => 'required|string|max:10',
            'status'                        => 'required|string|max:15',
            'registration_date'             => 'required|string|max:10',
            'registration_expiration_date'  => 'required|string|max:10',
        ]);

        $vehicle->update($validatedData);

        return redirect()->route('vehicle.show', $vehicle);
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

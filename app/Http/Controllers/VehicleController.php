<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Carbon\Carbon;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $vehicles = Vehicle::orderBy('created_at', 'desc')->get();

        return Inertia::render('Vehicle/Index', ['Vehicles' => $vehicles]);
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
        'plateNumber'         => 'required|string|max:10',
        'model'              => 'required|string|max:255',
        'capacity'           => 'required|integer',
        'status'             => 'required|string|max:50',
        'calibrationDate'    => 'nullable|date',
        'calibrationExpDate' => 'nullable|date',
        'LTOregDate'         => 'nullable|date',
        'LTOExpDate'         => 'nullable|date',
        'conveyanceDate'     => 'nullable|date',
        'conveyanceExpDate'  => 'nullable|date',
        'filcomFabDate'      => 'nullable|date',
        'filconExpDate'      => 'nullable|date',
        'LTFRBRegDate'       => 'nullable|date',
        'LTFRBExpDate'       => 'nullable|date',
        'engineNumber'       => 'required|string|max:20',
        'PMSRegDate'         => 'nullable|date',
        'PMSLastMileAge'     => 'required|string|max:255',
        'PMSCurrentReading'  => 'required|string|max:255',
        'consumeMileage'     => 'required|integer',
        'nextPMSMileage'     => 'required|integer',
    ]);

        $validatedData['calibrationDate'] = Carbon::parse($validatedData['calibrationDate'])->format('Y-m-d H:i:s');
        $validatedData['calibrationExpDate'] = Carbon::parse($validatedData['calibrationExpDate'])->format('Y-m-d H:i:s');
        $validatedData['LTOregDate'] = Carbon::parse($validatedData['LTOregDate'])->format('Y-m-d H:i:s');
        $validatedData['LTOExpDate'] = Carbon::parse($validatedData['LTOExpDate'])->format('Y-m-d H:i:s');
        $validatedData['conveyanceDate'] = Carbon::parse($validatedData['conveyanceDate'])->format('Y-m-d H:i:s');
        $validatedData['conveyanceExpDate'] = Carbon::parse($validatedData['conveyanceExpDate'])->format('Y-m-d H:i:s');
        $validatedData['filcomFabDate'] = Carbon::parse($validatedData['filcomFabDate'])->format('Y-m-d H:i:s');
        $validatedData['filconExpDate'] = Carbon::parse($validatedData['filconExpDate'])->format('Y-m-d H:i:s');
        $validatedData['LTFRBRegDate'] = Carbon::parse($validatedData['LTFRBRegDate'])->format('Y-m-d H:i:s');
        $validatedData['LTFRBExpDate'] = Carbon::parse($validatedData['LTFRBExpDate'])->format('Y-m-d H:i:s');
        $validatedData['PMSRegDate'] = Carbon::parse($validatedData['PMSRegDate'])->format('Y-m-d H:i:s');


    // Create and save a new vehicle record
    Vehicle::create([
        'license_plate'                => $validatedData['plateNumber'],
        'model'                        => $validatedData['model'],
        'capacity'                     => $validatedData['capacity'],
        'status'                       => $validatedData['status'],
        'calibration_date'             => $validatedData['calibrationDate'],
        'calibration_exp_date'         => $validatedData['calibrationExpDate'],
        'lto_reg_date'                 => $validatedData['LTOregDate'],
        'lto_exp_date'                 => $validatedData['LTOExpDate'],
        'conveyance_date'              => $validatedData['conveyanceDate'],
        'conveyance_exp_date'          => $validatedData['conveyanceExpDate'],
        'filcom_fab_date'              => $validatedData['filcomFabDate'],
        'filcon_exp_date'              => $validatedData['filconExpDate'],
        'ltfrb_reg_date'               => $validatedData['LTFRBRegDate'],
        'ltfrb_exp_date'               => $validatedData['LTFRBExpDate'],
        'engine_number'                => $validatedData['engineNumber'],
        'pms_reg_date'                 => $validatedData['PMSRegDate'],
        'pms_last_mileage'             => $validatedData['PMSLastMileAge'],
        'pms_current_reading'          => $validatedData['PMSCurrentReading'],
        'consume_mileage'              => $validatedData['consumeMileage'],
        'next_pms_mileage'             => $validatedData['nextPMSMileage'],

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
            'engine_number'                 => 'required|string|max:15',
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

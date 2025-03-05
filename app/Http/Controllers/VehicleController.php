<?php

namespace App\Http\Controllers;

use App\Models\Maintenance_task;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Inertia\Inertia;


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

    public function filter(Request $request)
    {
        $status = $request->query('status');

        $vehicles = Vehicle::when($status, function ($query) use ($status) {
            return $query->where('status', $status);
        })->get();

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
        'plateNumber'        => 'required|string|max:10|unique:vehicles,license_plate',
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
        'engineNumber'       => 'required|string|max:20|unique:vehicles,engine_number',
        'PMSRegDate'         => 'required|date',
        'PMSLastMileAge'     => 'required|string|max:255',
        'PMSCurrentReading'  => 'required|string|max:255',
        'consumeMileage'     => 'required|integer',
        'nextPMSMileage'     => 'required|integer',
    ]);

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
            'license_plate'         => 'required|string|max:10|unique:vehicles,license_plate,' . $vehicle->id,
            'model'                 => 'required|string|max:255',
            'capacity'              => 'required|integer',
            'status'                => 'required|string|max:50',
            'calibration_date'      => 'nullable|date',
            'calibration_exp_date'  => 'nullable|date',
            'lto_reg_date'          => 'nullable|date',
            'lto_exp_date'          => 'nullable|date',
            'conveyance_date'       => 'nullable|date',
            'conveyance_exp_date'   => 'nullable|date',
            'filcom_fab_date'       => 'nullable|date',
            'filcon_exp_date'       => 'nullable|date',
            'ltfrb_reg_date'        => 'nullable|date',
            'ltfrb_exp_date'        => 'nullable|date',
            'engine_number'         => 'required|string|max:20|unique:vehicles,engine_number,' . $vehicle->id,
            'pms_reg_date'          => 'required|date',
            'pms_last_mileage'      => 'required|string|max:255',
            'pms_current_reading'   => 'required|string|max:255',
            'consume_mileage'       => 'required|integer',
            'next_pms_mileage'      => 'required|integer',
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

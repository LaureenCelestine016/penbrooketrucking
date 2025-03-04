<?php

namespace App\Http\Controllers;

use App\Models\Maintenance_task;
use Illuminate\Http\Request;
use App\Models\Trailer;
use App\Models\Vehicle;
use Inertia\Inertia;

class MaintenanceTaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $maintenance = Maintenance_task::with('vehicle', 'trailer')->orderBy('created_at', 'desc')->get();
        return Inertia::render('Maintenance/Index',['maintenance' => $maintenance]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {


        return Inertia::render('Maintenance/Create' ,[
            "trailer" =>  Trailer::where('status','Operational')->orderBy('created_at', 'desc')->get(['id', 'license_plate']),
            "tructor" =>  Vehicle::where('status','Operational')->orderBy('created_at', 'desc')->get(['id', 'license_plate']),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'tructorId'     => 'nullable|integer|exists:vehicles,id',
            'trailerId'     => 'nullable|integer|exists:trailers,id', // Changed to nullable
            'description'   => 'required|string|max:255',
            'quantity'      => 'required|numeric', // Changed from integer to numeric
            'unit'          => 'required|string',
            'price'         => 'required|numeric', // Changed from integer to numeric
            'total'         => 'required|numeric', // Changed from integer to numeric
            'odometer'      => 'required|numeric', // Changed from string to numeric
            'supplier'      => 'required|string',
            'ref_no'        => 'required|string',
            'remarks'       => 'nullable|string',
            'breakdown'     => 'required|date', // Adjusted for timestamp format
            'up'            => 'required|date', // Adjusted for timestamp format
        ]);

        Maintenance_task::create([
            'vehicle_id'                => $validatedData['tructorId'],
            'trailer_id'                => $validatedData['trailerId'],
            'item_description'          => $validatedData['description'],
            'quantity'                  => $validatedData['quantity'],
            'unit'                      => $validatedData['unit'],
            'price'                     => $validatedData['price'],
            'total'                     => $validatedData['total'],
            'odometer'                  => $validatedData['odometer'],
            'supplier'                  => $validatedData['supplier'],
            'ref_no'                    => $validatedData['ref_no'],
            'remarks'                   => $validatedData['remarks'],
            'breakdown_date'            => $validatedData['breakdown'],
            'up_date'                   => $validatedData['up'],
        ]);

        return redirect()->route('maintenance')->with('success', 'Maintenance created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Maintenance_task $maintenance_task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Maintenance_task $maintenance_task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Maintenance_task $maintenance_task)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Maintenance_task $maintenance_task)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Expenses;
use App\Models\Maintenance_task;
use Illuminate\Http\Request;
use App\Models\Trailer;
use App\Models\Vehicle;
use Inertia\Inertia;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

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

        $trailer = Trailer::where('status','Operational')->orderBy('created_at', 'desc')->get(['id', 'license_plate']);
        return Inertia::render('Maintenance/Create' ,[
            "trailer" =>  Trailer::orderBy('created_at', 'desc')->get(['id', 'license_plate']),
            "tructor" =>  Vehicle::orderBy('created_at', 'desc')->get(['id', 'license_plate']),
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
            'up'            => 'nullable|date|after_or_equal:breakdown', // Adjusted for timestamp format
        ]);


        try{
            DB::transaction(function () use ($validatedData, $request) {
                $maintenance = Maintenance_task::create([
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

                Expenses::create([
                    'maintenance_id'            => $maintenance->id,
                    'vehicle_id'                => $validatedData['tructorId'],
                    'trailer_id'                => $validatedData['trailerId'],
                    'category_id'               => 2,
                    'amount'                    => $validatedData['total'],
                    'description'               => $validatedData['description'],
                    'expense_date'              => $maintenance->created_at,

                ]);
            });
        } catch (\Exception $e) {
            dd($e->getMessage());
        }

        return redirect()->route('maintenance')->with('success', 'Maintenance created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Maintenance_task $maintenance_task)
    {

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

        $request->validate([
            'odometer'       => 'required|numeric|min:1',
            'quantity'       => 'required|numeric|min:1',
            'price'          => 'required|numeric|min:1',
            'total'          => 'required|numeric|min:1',
            'supplier'       => 'required|string',
            'breakdown'      => 'required|date',
            'up'             => 'required|date',
            'remarks'         => 'required|string',
        ]);

        $maintenance_task->update([
            'odometer'          => $request->odometer,
            'quantity'          => $request->quantity,
            'price'             => $request->price,
            'total'             => $request->total,
            'supplier'          => $request->supplier,
            'breakdown'         => $request->breakdown,
            'up'                => $request->up,
            'remarks'           => $request->remarks,
        ]);

        return redirect()->route('maintenance', $maintenance_task)->with('success', 'Maintenance record updated successfully!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Maintenance_task $maintenance_task)
    {
        $maintenance_task->delete();
        return redirect()->route('maintenance');
    }

    public function deletedAll(Request $request)
    {
        $ids = $request->ids;
        Maintenance_task::whereIn('id', $ids)->delete();

        return redirect()->route('maintenance');
    }
}

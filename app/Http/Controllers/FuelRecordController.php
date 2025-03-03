<?php

namespace App\Http\Controllers;

use App\Models\Expenses;
use App\Models\Fuel_record;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Carbon\Carbon;

class FuelRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $fuel = Fuel_record::with('vehicle')->orderBy('created_at','desc')->get();
        return Inertia::render('Fuel/Index', ['fuels' => $fuel]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return Inertia::render('Fuel/Create',["tructor" => Expenses::whereHas('tructor', function ($query) {
            $query->where('status', 'Operational');
        })
        ->with(['tructor' => function ($query) {
            $query->orderBy('created_at', 'desc');
        }])
        ->where('category_id', 3)
        ->orderBy('created_at', 'desc')
        ->get()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'vehicleId'         => 'required|integer|exists:vehicles,id',
            'liters'            => 'required|numeric|min:1',
            'cost'              => 'required|numeric|min:0',
            'fuel_type'         => 'required|string',
            'type'              => 'required|string',
            // 'image'             => 'required|string',
            'refuelingDate'     => 'required|date',
        ]);

        $validatedData['cost'] = round($validatedData['cost'], 2);
        $validatedData['refuelingDate'] = Carbon::parse($validatedData['refuelingDate'])->format('Y-m-d H:i:s');

        Fuel_record::create([
            'vehicle_id'           => $validatedData['vehicleId'],
            'liters'               => $validatedData['liters'],
            'cost'                 => $validatedData['cost'],
            'refueling_date'       => $validatedData['refuelingDate'],
            'fuel_type'            => $validatedData['fuel_type'],
            // 'image'                => $validatedData['image'],
            'type'                 => $validatedData['type'],

        ]);

        return redirect()->route('fuel')->with('success', 'Fuel created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Fuel_record $fuel_record)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Fuel_record $fuel_record)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Fuel_record $fuel_record)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Fuel_record $fuel_record)
    {

        $fuel_record->delete();
        return redirect()->route('fuel');
    }


    public function deletedAll(Request $request)
    {
        $ids = $request->ids;
        Fuel_record::whereIn('id', $ids)->delete();

        return redirect()->route('fuel');
    }
}

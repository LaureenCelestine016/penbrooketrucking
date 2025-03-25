<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Models\Expenses;
use App\Models\Fuel_record;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class FuelRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return Inertia::render('Fuel/Index', [
            'fuels' => Fuel_record::with('vehicle','driver')->orderBy('created_at','desc')->get(),
            'tractor' => Vehicle::orderBy('created_at','desc')->get(),
            'drivers' => Driver::where('status','active')->orderBy('created_at','desc')->get(),
        ]);


    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return Inertia::render('Fuel/Create',["tractor" => Vehicle::where('status', 'Operational')->get(['id','license_plate']),
        "driver" => Driver::where('status','active')->get(),
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
            'curr_odometer'     => 'required|numeric|min:1',
            'prev_odometer'     => 'required|numeric|min:1',
            'total_distance'    => 'required|numeric|min:1',
            'liters'            => 'required|numeric|min:1',
            'avg_fuel'          => 'required|numeric|min:0',
            'amount'            => 'required|numeric|min:0',
            'station'           => 'required|string',
            'date_refilled'     => 'required|date',
            'remarks'           => 'required|string',
        ]);

        $validatedData['amount'] = round($validatedData['amount'], 2);

        try{
            DB::transaction(function () use ($validatedData, $request) {
                $fuel = Fuel_record::create([
                    'vehicle_id'               => $validatedData['vehicleId'],
                    'driver_id'                => $validatedData['driverId'],
                    'current_odometer'         => $validatedData['curr_odometer'],
                    'previous_odometer'        => $validatedData['prev_odometer'],
                    'total_distance'           => $validatedData['total_distance'],
                    'total_refuel'             => $validatedData['liters'],
                    'avg_fuel_consumption'     => $validatedData['avg_fuel'],
                    'amount'                   => $validatedData['amount'],
                    'station'                  => $validatedData['station'],
                    'remarks'                  => $validatedData['remarks'],
                    'refueling_date'           => $validatedData['date_refilled'],
                ]);

                Expenses::create([
                    'fuel_id'                   => $fuel->id,
                    'vehicle_id'                => $validatedData['vehicleId'],
                    'category_id'               => 3,
                    'amount'                    => $validatedData['amount'],
                    'description'               => $validatedData['remarks'],
                    'expense_date'              => $validatedData['date_refilled'],

                ]);
            });
        } catch (\Exception $e) {
            dd($e->getMessage());
        }




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

        $request->validate([
            'vehicleId'             => 'required|integer|exists:vehicles,id',
            'driverId'              => 'required|integer|exists:drivers,id',
            'current_odometer'      => 'required|numeric|min:1',
            'previous_odometer'     => 'required|numeric|min:1',
            'total_distance'        => 'required|numeric|min:1',
            'total_refuel'          => 'required|numeric|min:1',
            'avg_fuel_consumption'  => 'required|numeric|min:0',
            'amount'                => 'required|numeric|min:0',
            'station'               => 'required|string',
            'refueling_date'        => 'required|date',
            'remarks'               => 'required|string',
        ]);

        $fuel_record->update([
            'vehicle_id'            => $request->vehicleId,
            'driver_id'             => $request->driverId,
            'current_odometer'      => $request->current_odometer,
            'previous_odometer'     => $request->previous_odometer,
            'total_distance'        => $request->total_distance,
            'total_refuel'          => $request->total_refuel,
            'avg_fuel_consumption'  => $request->avg_fuel_consumption,
            'amount'                => $request->amount,
            'station'               => $request->station,
            'refueling_date'        => $request->refueling_date,
            'remarks'               => $request->remarks,
        ]);

        return redirect()->route('fuel', $fuel_record)->with('success', 'Fuel record updated successfully!');
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

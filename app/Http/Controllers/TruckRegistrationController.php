<?php

namespace App\Http\Controllers;

use App\Models\TruckRegistration;
use Illuminate\Http\Request;
use App\Models\Trailer;
use App\Models\Vehicle;
use App\Models\Expenses;
use Inertia\Inertia;
use Carbon\Carbon;

class TruckRegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Registration/Create',[
            'tructor' => Vehicle::orderBy('created_at', 'desc')->get(),
            'trailer' => Trailer::orderBy('created_at', 'desc')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(TruckRegistration $truckRegistration)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TruckRegistration $truckRegistration)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        if($request->truckId == "1") {
            $validatedData = $request->validate([
                'truckId' => 'required|string',
                'lto_reg_date' => 'nullable|date',
                'lto_exp_date' => 'nullable|date|after:lto_reg_date',
                'conveyance_date' => 'nullable|date',
                'conveyance_exp_date' => 'nullable|date|after:conveyance_date',
                'filcom_fab_date' => 'nullable|date',
                'ltfrb_reg_date' => 'nullable|date',
                'filcon_exp_date' => 'nullable|date',
                'ltfrb_exp_date' => 'nullable|date',
                'cost' => 'nullable|numeric|min:0',
                'remarks' => 'nullable|string|max:255',
            ]);

            $vehicle = Vehicle::findOrFail($id);


            if ($request->has('lto_reg_date')) {
                $vehicle->lto_reg_date = $request->input('lto_reg_date');
            }
            if ($request->has('lto_exp_date')) {
                $vehicle->lto_exp_date = $request->input('lto_exp_date');
                $vehicle->lto_is_Expired = Carbon::parse($vehicle->lto_exp_date)->isFuture() ? 0 : 1;
            }
            if ($request->has('conveyance_date')) {
                $vehicle->conveyance_date = $request->input('conveyance_date');
            }
            if ($request->has('conveyance_exp_date')) {
                $vehicle->conveyance_exp_date = $request->input('conveyance_exp_date');
                $vehicle->conveyance_is_Expired = Carbon::parse($vehicle->conveyance_exp_date)->isFuture() ? 0 : 1;
            }
            if ($request->has('filcom_fab_date')) {
                $vehicle->filcom_fab_date = $request->input('filcom_fab_date');
            }
            if ($request->has('filcon_exp_date')) {
                $vehicle->filcon_exp_date = $request->input('filcon_exp_date');
                $vehicle->filcon_is_Expired = Carbon::parse($vehicle->filcon_exp_date)->isFuture() ? 0 : 1;
            }
            if ($request->has('ltfrb_reg_date')) {
                $vehicle->ltfrb_reg_date = $request->input('ltfrb_reg_date');
            }
            if ($request->has('ltfrb_exp_date')) {
                $vehicle->ltfrb_exp_date = $request->input('ltfrb_exp_date');
                $vehicle->ltfrb_is_Expired = Carbon::parse($vehicle->ltfrb_exp_date)->isFuture() ? 0 : 1;
            }

            $vehicle->save();

            Expenses::create([
                'vehicle_id'                => $id,
                'category_id'               => 1,
                'amount'                    => $validatedData['cost'],
                'description'               => $validatedData['remarks'],
                'expense_date'              => $vehicle->updated_at,
            ]);

            return redirect()->route('registration.create', $vehicle)
                ->with('success', 'Vehicle registration updated successfully!');
        }

        if($request->truckId == "2") {
            $validatedData = $request->validate([

                'lto_reg_date' => 'nullable|date',
                'lto_exp_date' => 'nullable|date|after:lto_reg_date',
                'conveyance_date' => 'nullable|date',
                'conveyance_exp_date' => 'nullable|date|after:conveyance_date',
                'cost' => 'nullable|numeric|min:0',
                'remarks' => 'nullable|string|max:255',
            ]);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TruckRegistration $truckRegistration)
    {

    }
}

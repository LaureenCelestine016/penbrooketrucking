<?php

namespace App\Http\Controllers;

use App\Models\TruckRegistration;
use Illuminate\Http\Request;
use App\Models\Trailer;
use App\Models\Vehicle;
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
            $vehicle = Vehicle::findOrFail($id);

            // Update the expiration dates
            $vehicle->lto_reg_date = $request->input('lto_reg_date');
            $vehicle->lto_exp_date = $request->input('lto_exp_date');
            $vehicle->conveyance_date = $request->input('conveyance_date');
            $vehicle->conveyance_exp_date = $request->input('conveyance_exp_date');

            // Check if the new expiration date is in the future and update the is_Expired fields
            if (Carbon::parse($vehicle->lto_exp_date)->isFuture() ) {
                $vehicle->lto_is_Expired = 0;
            }

            if (Carbon::parse($vehicle->conveyance_exp_date)->isFuture()) {
                $vehicle->conveyance_is_Expired = 0;
            }

            // Save the changes
            $vehicle->save();

            return response()->json([
                'message' => 'Vehicle updated successfully!',
                'vehicle' => $vehicle
            ]);
        }



    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TruckRegistration $truckRegistration)
    {
        //
    }
}

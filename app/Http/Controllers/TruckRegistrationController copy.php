<?php

namespace App\Http\Controllers;

use App\Models\TruckRegistration;
use Illuminate\Http\Request;
use App\Models\Trailer;
use App\Models\Vehicle;
use App\Models\Expenses;
use App\Models\Notification;
use Inertia\Inertia;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class TruckRegistrationController extends Controller
{

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
                'expenses_date' => 'required|date',
                'remarks' => 'nullable|string|max:255',
            ]);

            $vehicle = Vehicle::findOrFail($id);
            $originalVehicle = $vehicle->getOriginal();

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

            $this->updateNotifications($originalVehicle, $request);

            Expenses::create([
                'vehicle_id'                => $id,
                'category_id'               => 1,
                'amount'                    => $validatedData['cost'],
                'description'               => $validatedData['remarks'],
                'expense_date'              => $validatedData['expenses_date']
            ]);

            return redirect()->route('registration.create', $vehicle)
                ->with('success', 'Vehicle registration updated successfully!');
        }

        if($request->truckId == "2") {
            $validatedData = $request->validate([
                'lto_reg_date' => 'nullable|date',
                'lto_exp_date' => 'nullable|date|after:lto_reg_date',
                'calibration_date' => 'nullable|date',
                'calibration_exp_date' => 'nullable|date|after:conveyance_date',
                'cost' => 'nullable|numeric|min:0',
                'remarks' => 'nullable|string|max:255',
                'expenses_date' => 'required|date',
            ]);

            $trailer = Trailer::findOrFail($id);
            $originalTrailer = $trailer->getOriginal();

            if ($request->has('lto_reg_date')) {
                $trailer->lto_reg_date = $request->input('lto_reg_date');
            }
            if ($request->has('lto_exp_date')) {
                $trailer->lto_exp_date = $request->input('lto_exp_date');
                $trailer->lto_is_Expired = Carbon::parse($trailer->lto_exp_date)->isFuture() ? 0 : 1;
            }
            if ($request->has('calibration_date')) {
                $trailer->calibration_date = $request->input('calibration_date');
            }
            if ($request->has('calibration_exp_date')) {
                $trailer->calibration_exp_date = $request->input('calibration_exp_date');
                $trailer->calibration_is_Expired = Carbon::parse($trailer->calibration_exp_date)->isFuture() ? 0 : 1;
            }

            $trailer->save();

            $this->updateNotifications($originalTrailer, $request);

        }

    }

    private function updateNotifications($originalVehicle, $request)
    {

        $notificationFields = [
            'lto_exp_date' => 'Lto exp date is about to expire on',
            'conveyance_exp_date' => 'Conveyance exp date is about to expire on',
            'filcon_exp_date' => 'Filcon exp date is about to expire on',
            'ltfrb_exp_date' => 'Ltfrb exp date is about to expire on',
            'calibration_exp_date' => 'Calibration exp date is about to expire on'
        ];

        foreach ($notificationFields as $field => $messageType) {
            if ($request->has($field)) {
                $newExpDate = Carbon::parse($request->input($field))->format('Y-m-d');
                $oldExpDate = Carbon::parse($originalVehicle[$field])->format('Y-m-d');


                Log::info("Checking {$messageType}: Old Date: {$oldExpDate}, New Date: {$newExpDate}");

                if ($oldExpDate == $newExpDate) {
                    Log::info("Skipping {$messageType}, no change detected");
                    continue;
                }

                Log::info("Processing {$messageType} notifications for date: {$newExpDate}");

                if($request->truckId == "1") {

                    $matchingNotifications = Notification::where('vehicle_id', $originalVehicle['id'])
                    ->where('status', 'pending')
                    ->where('message', 'LIKE', "%{$messageType}%")
                    ->where('message', 'LIKE', "%{$oldExpDate}%")
                    ->get();
                } else {
                    $matchingNotifications = Notification::where('trailer_id', $originalVehicle['id'])
                    ->where('status', 'pending')
                    ->where('message', 'LIKE', "%{$messageType}%")
                    ->where('message', 'LIKE', "%{$oldExpDate}%")
                    ->get();

                }

                Log::info("Potential matches for {$messageType}: " . json_encode($matchingNotifications->pluck('message')));

                // Correct filtering
                $existingNotification = $matchingNotifications->first(fn($n) => str_contains($n->message, $oldExpDate));

                if ($existingNotification) {
                    Log::info("Found matching notification: ID {$existingNotification->id}, updating to resolved");
                    $existingNotification->status = 'resolved';
                    $existingNotification->updated_at = now();
                    $existingNotification->save();
                } else {
                    Log::warning("No exact match found for {$messageType} with date {$newExpDate}");
                }
            }
        }
    }

    public function edit($id)
    {
        $vehicle = Vehicle::findOrFail($id);

        return Inertia::render('Registration/Create', [
            "Vehicle" => $vehicle,
            ]
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TruckRegistration $truckRegistration)
    {

    }
}

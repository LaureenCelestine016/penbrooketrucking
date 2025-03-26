<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Vehicle;
use App\Models\Notification;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class CheckVehicleExpiration
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
{
    $today = Carbon::today();

    $fiveDaysBefore = $today->copy()->addDays(5); // 5 days from today


    $expiryFields = [
        'lto_exp_date' => 'lto_is_Expired',
        'conveyance_exp_date' => 'conveyance_is_Expired',
        'filcon_exp_date' => 'filcon_is_Expired',
        'ltfrb_exp_date' => 'ltfrb_is_Expired',
    ];

    $this->checkAndUpdateExpiration(Vehicle::all(), $expiryFields, $fiveDaysBefore);

    return $next($request);
}
private function checkAndUpdateExpiration($vehicles, $expiryFields, $fiveDaysBefore)
{
    foreach ($vehicles as $vehicle) {
        foreach ($expiryFields as $expDateColumn => $isExpiredColumn) {



            if (!empty($vehicle->$expDateColumn) && Carbon::parse($vehicle->$expDateColumn)->lessThanOrEqualTo($fiveDaysBefore) && $vehicle->$isExpiredColumn == 0) {
                // Use a transaction to ensure updates and notification creation happen together
                DB::transaction(function () use ($vehicle, $expDateColumn, $isExpiredColumn) {
                    // Update expiration status
                    $vehicle->$isExpiredColumn = 1;
                    $vehicle->save();

                    // Create notification
                    Notification::create([
                        'vehicle_id' => $vehicle->id,
                        'message' => "{$vehicle->license_plate} {$vehicle->model}: " . ucfirst(str_replace('_', ' ', $expDateColumn)) . " is about to expire on " . $vehicle->$expDateColumn,
                        'status' => 'pending',
                        'reported_at' => now(),
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                });
            }
        }
    }
}
}

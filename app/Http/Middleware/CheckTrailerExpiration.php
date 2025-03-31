<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Trailer;
use App\Models\Notification;
use Carbon\Carbon;

class CheckTrailerExpiration
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $today = Carbon::today();
        $fiveDaysBefore = $today->copy()->addDays(5);;

        $expiryFields = [
            'lto_exp_date' => 'lto_is_Expired',
            'calibration_exp_date' => 'calibration_is_Expired',

        ];

        $this->checkAndUpdateExpiration(Trailer::all(), 'Trailer', $expiryFields, $fiveDaysBefore);

        return $next($request);
    }

    private function checkAndUpdateExpiration($items, $type, $expiryFields, $fiveDaysBefore)
    {
        foreach ($items as $item) {
            foreach ($expiryFields as $expDateColumn => $isExpiredColumn) {
                if (!empty($item->$expDateColumn) && $item->$expDateColumn <= $fiveDaysBefore && $item->$isExpiredColumn == 0) {
                    // Update expiration status
                    $item->update([$isExpiredColumn => 1]);

                    Notification::create([
                        'trailer_id' => $item->id,
                        'message' => "{$item->license_plate}"." "."{$item->model}: " . ucfirst(str_replace('_', ' ', $expDateColumn)) . " is about to expire on " . $item->$expDateColumn,
                        'status' => 'pending',
                        'reported_at' => now(),
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }
    }
}

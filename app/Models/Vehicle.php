<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Fuel_record;
use Carbon\Carbon;

class Vehicle extends Model
{
    use HasFactory, SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
       'license_plate',
       'model',
       'capacity',
       'status',
       'lto_reg_date',
       'lto_exp_date',
       'lto_is_Expired',
       'conveyance_date',
       'conveyance_exp_date',
       'conveyance_is_Expired',
       'filcom_fab_date',
       'filcon_exp_date',
       'filcon_is_Expired',
       'ltfrb_reg_date',
       'ltfrb_exp_date',
       'ltfrb_is_Expired',
       'engine_number',
       'pms_reg_date',
       'pms_last_mileage',
       'pms_current_reading',
       'consume_mileage',
       'next_pms_mileage',
       'image'
    ];

    protected static function boot()
    {
    parent::boot();

    static::updating(function ($vehicle) {
        $now = Carbon::now();

        // Only update to 1 if it's not already 1
        if ($vehicle->lto_is_Expired === 1) {
            $vehicle->lto_is_Expired = $now->gt(Carbon::parse($vehicle->lto_exp_date)) ? 1 : 0;
        }
        if ($vehicle->conveyance_is_Expired === 1) {
            $vehicle->conveyance_is_Expired = $now->gt(Carbon::parse($vehicle->conveyance_exp_date)) ? 1 : 0;
        }
        if ($vehicle->filcon_is_Expired === 1) {
            $vehicle->filcon_is_Expired = $now->gt(Carbon::parse($vehicle->filcon_exp_date)) ? 1 : 0;
        }
        if ($vehicle->ltfrb_is_Expired === 1) {
            $vehicle->ltfrb_is_Expired = $now->gt(Carbon::parse($vehicle->ltfrb_exp_date)) ? 1 : 0;
        }
    });
    }


    public function gpsTrackers()
    {
        return $this->hasMany(GpsTracker::class);
    }

    public function fuelRecords()
    {
        return $this->hasMany(Fuel_Record::class, 'vehicle_id')->withTrashed();
    }

    public function maintenanceTasks()
    {
        return $this->hasMany(Maintenance_task::class);
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    public function routes()
    {
        return $this->hasMany(Route::class);
    }

    public function expenses()
    {
        return $this->hasMany(Expenses::class, 'vehicle_id');
    }


}

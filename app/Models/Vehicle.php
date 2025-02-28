<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Fuel_record;

class Vehicle extends Model
{
    use HasFactory, SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
       'license_plate',
       'model',
       'capacity',
       'status',
       'calibration_date',
       'calibration_exp_date',
       'lto_reg_date',
       'lto_exp_date',
       'conveyance_date',
       'conveyance_exp_date',
       'filcom_fab_date',
       'filcon_exp_date',
       'ltfrb_reg_date',
       'ltfrb_exp_date',
       'engine_number',
       'pms_reg_date',
       'pms_last_mileage',
       'pms_current_reading',
       'consume_mileage',
       'next_pms_mileage',
       'image'
    ];


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
}

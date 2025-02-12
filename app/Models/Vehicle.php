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
        'name',
        'type',
        'model',
        'status',
        'chassis_number',
        'engine_number',
        'manufacturer',
        'manufacture_year',
        'registration_number',
        'registration_date',
        'registration_expiration_date',
        'license_plate',
        'image',
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

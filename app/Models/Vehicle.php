<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vehicle extends Model
{
    use HasFactory, SoftDeletes;

    public function gpsTrackers()
    {
        return $this->hasMany(GpsTracker::class);
    }

    public function fuelRecords()
    {
        return $this->hasMany(Fuel_record::class);
    }

    public function maintenanceTasks()
    {
        return $this->hasMany(Maintenance_task::class);
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Location extends Model
{
    use HasFactory, SoftDeletes;

    public function gpsLogs()
    {
        return $this->hasMany(GpsLog::class);
    }

    public function startRoutes()
    {
        return $this->hasMany(Route::class, 'start_location_id');
    }

    public function endRoutes()
    {
        return $this->hasMany(Route::class, 'end_location_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Gpstracker extends Model
{
    use HasFactory, SoftDeletes;

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function gpsLogs()
    {
        return $this->hasMany(GpsLog::class);
    }
}

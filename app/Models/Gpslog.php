<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Gpslog extends Model
{
    use HasFactory, SoftDeletes;

    public function gpsTracker()
    {
        return $this->belongsTo(GpsTracker::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }
}

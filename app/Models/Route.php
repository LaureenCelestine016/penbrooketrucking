<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Route extends Model
{
    use HasFactory, SoftDeletes;

    public function startLocation()
    {
        return $this->belongsTo(Location::class, 'start_location_id');
    }

    // A route has one end location (Location)
    public function endLocation()
    {
        return $this->belongsTo(Location::class, 'end_location_id');
    }
}

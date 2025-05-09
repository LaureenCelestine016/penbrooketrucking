<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Route extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'gpstracker_id', 'vehicle_id', 'driver_id', 'trailer_id',
        'start_location_id', 'end_location_id',
        'start_date', 'end_date', 'distance_km', 'status'
    ];

    public function startLocation()
    {
        return $this->belongsTo(Location::class, 'start_location_id');
    }

    // A route has one end location (Location)
    public function endLocation()
    {
        return $this->belongsTo(Location::class, 'end_location_id');
    }

    public function gpsTracker()
    {
        return $this->belongsTo(GpsTracker::class, 'gpstracker_id');
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    // Relationship with Driver
    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }

    public function fuelRecord()
    {
        return $this->belongsTo(Fuel_record::class, 'fuel_id');
    }

    public function trailer()
    {
        return $this->belongsTo(Trailer::class);
    }

}

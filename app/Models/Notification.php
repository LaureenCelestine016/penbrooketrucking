<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{

    use HasFactory;

    protected $fillable = [
        'vehicle_id',
        'trailer_id',
        'message',
        'status',
        'reported_at'
     ];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function trailer()
    {
        return $this->belongsTo(Trailer::class);
    }

    // A notification may belong to a driver
    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fuel_record extends Model
{
    use HasFactory, SoftDeletes;

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
}

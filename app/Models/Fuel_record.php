<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fuel_record extends Model
{
    use HasFactory, SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'fuel_records';

    protected $fillable = [
        'vehicle_id',
        'driver_id',
        'current_odometer',
        'previous_odometer',
        'total_distance',
        'total_refuel',
        'avg_fuel_consumption',
        'amount',
        'station',
        'remarks',
        'refueling_date',
        'is_used'
    ];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }

    public function routes()
    {
        return $this->hasMany(Route::class, 'fuel_id');
    }

    public function expense()
    {
        return $this->belongsTo(Expenses::class, 'expense_id');
    }
}

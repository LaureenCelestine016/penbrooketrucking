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
        'liters',
        'cost',
        'refueling_date',
        'fuel_type',
        'is_used',
        'image',
        'type'
    ];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
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

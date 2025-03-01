<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Expenses extends Model
{
    use HasFactory, SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
       'vehicle_id',
       'trailer_id',
       'category_id',
       'amount',
       'description',
       'expense_date',

    ];

    public function category()
    {
        return $this->belongsTo(Expenses_Caterogry::class, 'category_id');
    }

    public function maintenance()
    {
        return $this->hasOne(Maintenance_task::class, 'expense_id');
    }

    public function fuel()
    {
        return $this->hasOne(Fuel_record::class, 'expense_id');
    }

    public function tructor()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_id');
    }

    public function trailer()
    {
        return $this->belongsTo(Trailer::class, 'trailer_id');
    }

    // public function registration()
    // {
    //     return $this->hasOne(RegistrationRecord::class, 'expense_id');
    // }
}

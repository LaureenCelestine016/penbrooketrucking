<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Maintenance_task extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'vehicle_id',
        'trailer_id',
        'item_description',
        'quantity',
        'unit',
        'price',
        'total',
        'odometer',
        'supplier',
        'ref_no',
        'remarks',
        'breakdown_date',
        'up_date',

     ];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function trailer()
    {
        return $this->belongsTo(Trailer::class);
    }

    public function expense()
    {
        return $this->belongsTo(Expenses::class, 'expense_id');
    }
}

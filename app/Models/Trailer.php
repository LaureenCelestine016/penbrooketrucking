<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Trailer extends Model
{
    use HasFactory, SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'license_plate',
        'body_number',
        'status',
        'calibration_date',
        'calibration_exp_date',
        'lto_reg_date',
        'lto_exp_date',
        'conveyance_date',
        'conveyance_exp_date',
        'filcom_fab_date',
        'filcon_exp_date',
        'ltfrb_reg_date',
        'ltfrb_exp_date',
        'image'
     ];

    public function routes()
    {
        return $this->hasMany(Route::class);
    }

    public function maintenanceTasks()
    {
        return $this->hasMany(Maintenance_task::class);
    }

    public function expenses()
    {
        return $this->hasMany(Expenses::class, 'trailer_id');
    }

}

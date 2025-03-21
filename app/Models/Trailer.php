<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

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
        'calibration_is_Expired',
        'lto_reg_date',
        'lto_exp_date',
        'lto_is_Expired',
        'image'
     ];

     protected static function boot()
     {
         parent::boot();

         static::updating(function ($trailer) {
             // Get current date
             $now = Carbon::now();

             // Update expiration statuses based on current date
             $trailer->lto_is_Expired = $now->gt($trailer->lto_exp_date) ? 1 : 0;
             $trailer->calibration_is_Expired = $now->gt($trailer->calibration_exp_date) ? 1 : 0;

         });
     }

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

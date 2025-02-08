<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Driver extends Model
{
    use HasFactory, SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'drivers';

    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'civil_status',
        'birthday',
        'address',
        'contact_number',
        'contact_person',
        'age',
        'image',
        'pagibig_no',
        'philhealth_no',
        'contact_no_person',
        'relation',
        'sss_no',
        'tin_no',
        'license_number',
        'license_expired',
        'status',
    ];

    public function user()
    {
    return $this->hasOne(User::class, 'driver_id', 'id');
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    public function routes()
    {
        return $this->hasMany(Route::class);
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory;

    protected $primaryKey = 'driver_id';
    protected $table = 'drivers';

    protected $fillable = [
        'license_number',
        'first_name',
        'last_name',
        'phone_number',
        'address',
        'date_of_birth',
        'updated_by_admin_id',
    ];

    /**
     * Get the buses assigned to the driver.
     */

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'updated_by_admin_id', 'admin_id');
    }
    
    public function buses()
    {
        return $this->hasMany(Bus::class, 'driver_id', 'driver_id');
    }
}
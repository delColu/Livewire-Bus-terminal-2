<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    // --- FIX: Explicitly set the table name --- 
    protected $table = 'schedules'; 
    // ------------------------------------------

    // Define the custom primary key
    protected $primaryKey = 'schedule_id';

    // Define fillable fields for mass assignment
    protected $fillable = [
        'bus_id',
        'driver_id',
        'route_id',
        'departure_time',
        'arrival_time',
        'updated_by_admin_id',
    ];

    public function bus()
    {
        return $this->belongsTo(Bus::class, 'bus_id', 'bus_id');
    }

    public function route()
    {
        return $this->belongsTo(Route::class, 'route_id', 'route_id');
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class, 'driver_id', 'driver_id');
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'updated_by_admin_id', 'admin_id');
    }

    

}
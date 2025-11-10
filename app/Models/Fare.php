<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fare extends Model
{
    use HasFactory;

    protected $primaryKey = 'fare_id';
    protected $table = 'fares';

    protected $fillable = [
        'route_id',
        'base_fare',
        'increase_fare_per_KM',
        'updated_by_admin_id',
    ];

    /**
     * Get the route associated with the fare.
     */

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'updated_by_admin_id', 'admin_id');
    }

    public function bustype()
    {
        return $this->hasMany(BusType::class, 'type_id', 'type_id');
    }
}
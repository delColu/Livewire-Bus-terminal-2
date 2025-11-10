<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Route extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'start_location', 'end_location', 'distance_km', 'base_fare', 'updated_by_admin_id'];
 
    public function schedules(): HasMany
    {
        return $this->hasMany(Schedule::class);
    }
}
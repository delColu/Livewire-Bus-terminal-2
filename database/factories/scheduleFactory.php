<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Admin;
use App\Models\Bus;
use App\Models\Driver;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\schedule>
 */
class scheduleFactory extends Factory
{
    /** 
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    // protected $fillable = [
    //     'bus_id',
    //     'driver_id',
    //     'departure_time',
    //     'arrival_time',
    //     'updated_by_admin_id',
    // ];
    public function definition(): array
    {
        return [
            'bus_id' => Bus::query()->inRandomOrder()->value('bus_id') 
                ?? Bus::factory(),
            'driver_id' => Driver::query()->inRandomOrder()->value('driver_id') 
                ?? Driver::factory(),
            'departure_time' => $this->faker->dateTimeBetween('+1 days', '+1 month'),
            'arrival_time' => $this->faker->dateTimeBetween('+1 days', '+1 month'),
            'updated_by_admin_id' => Admin::query()->inRandomOrder()->value('driver_id') 
                ?? Driver::factory(),
        ];
    }
}

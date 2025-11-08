<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\fare>
 */
class fareFactory extends Factory
{ 

    // protected $primaryKey = 'fare_id';
    // protected $table = 'fare';

    // protected $fillable = [
    //     'route_id',
    //     'fare_amount',
    //     'updated_by_admin_id',
    // ];
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'route_id' => $this->faker->numberBetween(1, 10),
            'fare_amount' => $this->faker->randomFloat(2, 50, 500),
            'updated_by_admin_id' => \App\Models\Admin::query()->inRandomOrder()->value('id') 
                ?? \App\Models\Admin::factory()
        ];
    }
}

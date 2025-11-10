<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bustype>
 */ 

// protected $primaryKey = 'type_id';
//     protected $table = 'bus_types';

//     protected $fillable = [
//         'type_name',
//         'description',
//     ];
class BustypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'type_name' => $this->faker->unique()->randomElement(['Air-conditioned', 'Regular']),
            'description' => $this->faker->sentence(),
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\route>
 */
class routeFactory extends Factory
{
    /** 
     * Define the model's default state.
     *protected $fillable = ['name'];
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->city . ' to ' . $this->faker->unique()->city,
        ];
    }
}

<?php

namespace Database\Factories; 

use Illuminate\Database\Eloquent\Factories\Factory;
use APP\Models\driver;  

// /**
//  * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\driver>
//  * 'license_number',
//         'first_name',
//         'last_name',
//         'phone_number',
//         'address',
//         'date_of_birth',
//         'updated_by_admin_id',
//  */
class driverFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'license_number' => $this->faker->unique()->bothify('???#####'),
            'phone_number' => $this->faker->phoneNumber(),
            'address' => $this->faker->address(),
            'date_of_birth' => $this->faker->date(),
            'updated_by_admin_id' => \App\Models\Admin::inRandomOrder()->first()->id,
        ];
    }
}

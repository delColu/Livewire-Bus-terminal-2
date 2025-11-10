<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use APP\Models\Bus;
// protected $fillable = [
//         'driver_id',
//         'bus_number',
//         'capacity',
//         'route_id',
//         'type_id',
//         'official_receipt_number',
//         'certificate_of_registration',
//         'updated_by_admin_id',
//     ];

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\bus>
 */
class busFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'driver_id' => \App\Models\Driver::query()->inRandomOrder()->value('driver_id') 
                ?? \App\Models\Driver::factory(),
                
            'bus_number' => $this->faker->unique()->bothify('BUS-####'),

            'capacity' => $this->faker->numberBetween(20, 60),

            'route_id' => \App\Models\Route::query()->inRandomOrder()->value('route_id') 
                ?? \App\Models\Route::factory(),

            'type_id' => \App\Models\BusType::query()->inRandomOrder()->value('type_id') 
                ?? \App\Models\BusType::factory(), 

            'official_receipt_number' => $this->faker->unique()->numerify('ORN-########'),

            'certificate_of_registration' => $this->faker->unique()->bothify('COR-########'),

            'updated_by_admin_id' => \App\Models\Admin::query()->inRandomOrder()->value('id') 
                ?? \App\Models\Admin::factory(),

        ];
    }
}

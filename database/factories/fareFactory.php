<?php

namespace Database\Factories;

use App\Models\BusType;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\route;
use App\Models\Admin;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\fare>
 */
class fareFactory extends Factory
{ 

    // protected $primaryKey = 'fare_id';
    // protected $table = 'fare';

    // // Schema::create('fare', function (Blueprint $table) {
    //         $table->id('fare_id'); // Custom primary key name
    //         $table->foreignId('route_id')->constrained('routes', 'route_id')->onDelete('cascade');
    //         $table->foreignId('type_id')->constrained('bus_types', 'type_id')->onDelete('cascade'); // Renamed from bus_type_id
    //         $table->decimal('base_fare', 10, 2);
    //         $table->decimal('increase_fare_per_KM', 10, 2); // 2 pesos per KM
    //         $table->unsignedBigInteger('updated_by_admin_id')->nullable(); // Soft foreign key to admin_users
    //         $table->timestamps(); // updated_at
    //     });
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'type_id' => BusType::inRandomOrder()->first()->type_id,
            'base_fare' => $this->faker->randomFloat(2, 100, 300),
            'increase_fare_per_KM' => $this->faker->randomFloat(2, 1, 10),
            'updated_by_admin_id' => Admin::query()->inRandomOrder()->value('id') 
                ?? Admin::factory()
        ];
    }
}

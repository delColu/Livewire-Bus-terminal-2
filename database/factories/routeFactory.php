<?php

namespace Database\Factories;

use App\Models\Fare;
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
    // Schema::create('routes', function (Blueprint $table) {
    //         $table->id('route_id'); // Custom primary key name
    //         $table->string('route_name', 50)->unique(); // e.g., Tagbilaran - Tubigon
    //         $table->string('start_location', 100);
    //         $table->string('end_location', 100);
    //         $table->decimal('base_fare', 10, 2); // Base fare as per ERD
    //         $table->unsignedBigInteger('updated_by_admin_id')->nullable(); // Soft foreign key to admin_users
    //         $table->timestamps(); // updated_at
    //     });
    public function definition(): array
    {
        return [
            'route_name' => $this->faker->unique()->city . ' - ' . $this->faker->unique()->city,
            'start_location' => $this->faker->city,
            'end_location' => $this->faker->city,
            'distance_km' => $this->faker->numberBetween(10, 500),
            'base_fare' => Fare::inRandomOrder()->value('base_fare'),
            'updated_by_admin_id' => null,
        ];
    }
}

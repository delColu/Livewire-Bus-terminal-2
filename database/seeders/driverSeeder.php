<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\driver;

class driverSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        driver::factory()->count(10)->create();
    }
}

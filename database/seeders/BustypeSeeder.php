<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\BusType;

class BustypeSeeder extends Seeder
{
    /** 
     * Run the database seeds.
     */
    public function run(): void
    {
        BusType::factory()->count(2)->create();
    }
}

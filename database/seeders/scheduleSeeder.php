<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Schedule;

class scheduleSeeder extends Seeder
{
    /**
     * Run the database seeds. 
     */
    public function run(): void
    {
        Schedule::factory()->count(20)->create();
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{ 
    public function up(): void
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id('schedule_id'); // Custom primary key name
            
            $table->unsignedBigInteger('bus_id');
            $table->foreignId('driver_id')->constrained('drivers', 'driver_id')->onDelete('cascade');            
            $table->time('departure_time');
            $table->foreignId('route_id')->constrained('routes', 'route_id')->onDelete('cascade');
            $table->time('arrival_time');
            $table->foreignId('updated_by_admin_id')->constrained('admins', 'id')->onDelete('cascade'); 
            $table->timestamps(); // updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
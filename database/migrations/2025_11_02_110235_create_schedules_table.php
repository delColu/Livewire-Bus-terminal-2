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
            
            // Explicitly define foreign key to buses table, referencing 'bus_id'
            $table->unsignedBigInteger('bus_id');
            $table->foreign('bus_id')->references('bus_id')->on('buses')->onDelete('cascade');
            
            // Explicitly define foreign key to drivers table, referencing 'driver_id'
            $table->unsignedBigInteger('driver_id');
            $table->foreign('driver_id')->references('driver_id')->on('drivers')->onDelete('cascade');
            
            $table->time('departure_time');
            $table->time('arrival_time');
            $table->unsignedBigInteger('updated_by_admin_id')->nullable(); 
            $table->timestamps(); // updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
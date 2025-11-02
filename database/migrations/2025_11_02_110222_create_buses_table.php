<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('buses', function (Blueprint $table) {
            $table->id('bus_id'); // Custom primary key name
            
            // Driver Foreign Key
            $table->unsignedBigInteger('driver_id');
            $table->foreign('driver_id')->references('driver_id')->on('drivers')->onDelete('cascade');
            
            $table->string('bus_number', 10)->unique();
            $table->integer('capacity');
            
            // Route Foreign Key
            $table->unsignedBigInteger('route_id');
            $table->foreign('route_id')->references('route_id')->on('routes')->onDelete('cascade');
            
            // Bus Type Foreign Key
            $table->unsignedBigInteger('type_id');
            $table->foreign('type_id')->references('type_id')->on('bus_types')->onDelete('cascade'); 
            
            $table->string('official_receipt_number', 50)->unique()->nullable();
            $table->string('certificate_of_registration', 50)->unique()->nullable();
            $table->unsignedBigInteger('updated_by_admin_id')->nullable(); 
            $table->timestamps(); // updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('buses');
    }
};
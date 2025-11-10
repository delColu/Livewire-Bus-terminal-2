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
            
            $table->unsignedBigInteger('driver_id')->nullable();
            $table->string('bus_number', 20)->unique();
            $table->integer('capacity')->default(40);
            $table->unsignedBigInteger('route_id')->constrainted('routes', 'route_id')->onDelete('set null');
            $table->unsignedBigInteger('type_id')->constrained('bus_types', 'type_id')->onDelete('set null');
            
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
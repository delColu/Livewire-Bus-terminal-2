<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fare', function (Blueprint $table) {
            $table->id('fare_id'); // Custom primary key name
            $table->foreignId('route_id')->constrained('routes', 'route_id')->onDelete('cascade');
            $table->foreignId('type_id')->constrained('bus_types', 'type_id')->onDelete('cascade'); // Renamed from bus_type_id
            $table->decimal('base_fare', 10, 2);
            $table->decimal('increase_fare_per_KM', 10, 2); // 2 pesos per KM
            $table->unsignedBigInteger('updated_by_admin_id')->nullable(); // Soft foreign key to admin_users
            $table->timestamps(); // updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fare');
    }
};
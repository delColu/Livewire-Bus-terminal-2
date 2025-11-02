<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bus_types', function (Blueprint $table) {
            $table->id('type_id'); // Custom primary key name
            $table->string('type_name', 50)->unique(); // e.g., Normal, Air-Condition
            $table->text('description')->nullable();
            $table->unsignedBigInteger('updated_by_admin_id')->nullable(); // Soft foreign key to admin_users
            $table->timestamps(); // updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bus_types');
    }
};
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->string('name'); // Name of the location (e.g., city, landmark)
            $table->string('street')->nullable(); // Optional detailed address
            $table->string('barangay')->nullable(); // Optional detailed address
            $table->string('municipality')->nullable(); // Optional detailed address
            $table->string('city')->nullable(); // Optional detailed address
            $table->string('province')->nullable(); // Optional detailed address
            $table->string('region')->nullable(); // Optional detailed address
            $table->decimal('latitude', 10, 8)->nullable(); // Latitude for geolocation
            $table->decimal('longitude', 11, 8)->nullable(); // Longitude for geolocation
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('locations');
    }
};

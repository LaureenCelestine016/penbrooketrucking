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
        Schema::create('routes', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->foreignId('vehicle_id')->constrained('vehicles')->onDelete('cascade'); // Start location
            $table->foreignId('trailer_id')->constrained('trailers')->onDelete('cascade');
            $table->foreignId('driver_id')->constrained('drivers')->onDelete('cascade'); // Start location
            $table->foreignId('start_location_id')->constrained('locations')->onDelete('cascade'); // Start location
            $table->foreignId('end_location_id')->constrained('locations')->onDelete('cascade'); // End location
            $table->foreignId('fuel_id')->constrained('fuel_records')->onDelete('cascade'); // End location
            $table->date('start_date'); // Registration number is unique
            $table->date('end_date'); // Registration number is unique
            $table->decimal('distance_km', 8, 2); // Distance between locations in kilometers
            $table->enum('status', ['Yet to start', 'Completed','Ongoing','Cancelled'])->default('Yet to start');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('routes');
    }
};

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
        Schema::create('fuel_records', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id(); // Primary key
            $table->unsignedBigInteger('vehicle_id'); // Add the vehicle_id column as an unsigned big integer
            $table->foreign('vehicle_id')->references('id')->on('vehicles')->onDelete('cascade'); // Foreign key constraint
            $table->integer('quantity'); // Amount of fuel in liters/gallons, depending on the unit
            $table->decimal('cost', 10, 2); // Cost in decimal with precision and scale (e.g., 99999999.99)
            $table->date('refueling_date'); // The date of the refueling
            $table->string('fuel_type')->nullable(); // Optional: type of fuel (e.g., diesel, petrol)
            $table->string('liters')->nullable(); // Optional: type of fuel (e.g., diesel, petrol)
            $table->timestamps();
            $table->softDeletes(); // Add soft deletes column
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fuel_records');
    }
};

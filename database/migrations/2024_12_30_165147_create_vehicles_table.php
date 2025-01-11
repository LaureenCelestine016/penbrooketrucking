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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Shorter and descriptive
            $table->string('type'); // Simplified field name
            $table->string('model');
            $table->string('chassis_number')->unique(); // Ensure chassis number is unique
            $table->string('engine_number')->unique(); // Ensure engine number is unique
            $table->string('manufacturer'); // Manufacturer name (removed redundant 'by')
            $table->string('registration_number')->unique(); // Registration number is unique
            $table->date('registration_date')->unique(); // Registration number is unique
            $table->date('registration_expiration_date'); // Changed to date type for better validation
            $table->string('license_plate')->unique(); // License plate is unique
            $table->year('manufacture_year'); // Clearer field name
            $table->string('image')->nullable(); // Clearer field name
            $table->enum('status', ['active', 'inactive', 'maintenance'])->default('active'); // Predefined statuses
            $table->timestamps(); // Created and updated timestamps
            $table->softDeletes(); // For soft delete functionality
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};

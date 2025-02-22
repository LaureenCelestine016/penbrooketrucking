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
            $table->string('name');
            $table->string('type');
            $table->string('model');
            $table->string('chassis_number')->unique();
            $table->string('engine_number')->unique();
            $table->string('manufacturer');
            $table->string('registration_number')->unique();
            $table->date('registration_date');
            $table->date('registration_expiration_date');
            $table->string('license_plate')->unique();
            $table->year('manufacture_year');
            $table->string('image')->nullable();
            $table->enum('status', ['Operational', 'Non-Operational', 'Maintenance'])->default('Operational');
            $table->timestamps();
            $table->softDeletes();
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

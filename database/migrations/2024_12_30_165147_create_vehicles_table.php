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
            $table->string('license_plate')->unique();
            $table->string('model');
            $table->integer('capacity');
            $table->enum('status', ['Operational', 'Non-Operational', 'Maintenance'])->default('Operational');
            $table->date('calibration_date')->nullable();
            $table->date('calibration_exp_date')->nullable();
            $table->date('lto_reg_date')->nullable();
            $table->date('lto_exp_date')->nullable();
            $table->date('conveyance_date')->nullable();
            $table->date('conveyance_exp_date')->nullable();
            $table->date('filcom_fab_date')->nullable();
            $table->date('filcon_exp_date')->nullable();
            $table->date('ltfrb_reg_date')->nullable();
            $table->date('ltfrb_exp_date')->nullable();
            $table->string('engine_number')->unique();
            $table->date('pms_reg_date')->nullable();
            $table->string('pms_last_mileage')->nullable();
            $table->string('pms_current_reading')->nullable();
            $table->integer('consume_mileage');
            $table->integer('next_pms_mileage');
            $table->string('image')->nullable();
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

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
        Schema::create('trailers', function (Blueprint $table) {
            $table->id();
            $table->string('license_plate')->unique();
            $table->string('body_number')->unique();
            $table->enum('status', ['Operational', 'Non-Operational', 'Maintenance'])->default('Operational');
            $table->date('calibration_date')->nullable();
            $table->date('calibration_exp_date')->nullable();
            $table->integer('calibration_is_Expired')->default(0);
            $table->date('lto_reg_date')->nullable();
            $table->date('lto_exp_date')->nullable();
            $table->integer('lto_is_Expired')->default(0);
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
        Schema::dropIfExists('trailers');
    }
};

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
        Schema::create('drivers', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->string('first_name');
            $table->string('middle_name');
            $table->string('last_name');
            $table->string('civil_status');
            $table->date('birthday')->unique();
            $table->string('address');
            $table->integer('contact_number');
            $table->integer('contact_person');
            $table->unsignedTinyInteger('age'); // Age is usually a small positive integer
            $table->string('image')->nullable(); // Assuming this stores an image path or URL
            $table->integer('pagibig_no')->nullable();
            $table->integer('philhealth_no')->nullable();
            $table->integer('sss_no')->nullable();
            $table->integer('tin_no')->nullable();
            $table->string('license_number')->unique(); // License number should likely be unique
            $table->date('license_expired');
            $table->enum('status', ['Active', 'Inactive'])->default('active'); //
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('drivers');
    }
};

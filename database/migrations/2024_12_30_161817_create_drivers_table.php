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
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->string('civil_status');
            $table->date('birthday')->unique();
            $table->string('address');
            $table->string('contact_number', 20);
            $table->string('contact_person');
            $table->string('contact_no_person', 20);
            $table->string('relation');
            $table->unsignedTinyInteger('age'); // Age is usually a small positive integer
            $table->string('image')->nullable(); // Assuming this stores an image path or URL
            $table->string('pagibig_no')->nullable();
            $table->string('philhealth_no')->nullable();
            $table->string('sss_no')->nullable();
            $table->string('tin_no')->nullable();
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

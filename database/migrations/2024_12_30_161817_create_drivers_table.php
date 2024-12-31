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
            $table->string('name');
            $table->string('license_number')->unique(); // License number should likely be unique
            $table->string('civil_status');
            $table->string('address');
            $table->unsignedTinyInteger('age'); // Age is usually a small positive integer
            $table->date('license_expired');
            $table->string('image')->nullable(); // Assuming this stores an image path or URL
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

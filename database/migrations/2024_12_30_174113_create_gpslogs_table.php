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
        Schema::create('gpslogs', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->foreignId('gps_tracker_id')->constrained('gpstrackers')->onDelete('cascade'); // Reference to the GPS tracker
            $table->decimal('latitude', 10, 8); // Latitude of the GPS log
            $table->decimal('longitude', 11, 8); // Longitude of the GPS log
            $table->foreignId('location_id')->nullable()->constrained('locations')->onDelete('set null'); // Optionally map to a location
            $table->timestamp('logged_at')->useCurrent(); // Time of the log
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gpslogs');
    }
};

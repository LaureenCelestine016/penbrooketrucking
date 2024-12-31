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
        Schema::create('notifications', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->foreignId('vehicle_id')->constrained('vehicles')->onDelete('cascade');
            $table->foreignId('driver_id')->nullable()->constrained()->onDelete('cascade'); // Nullable if the notification may not always be linked to a driver
            $table->text('message');
            $table->enum('status', ['pending', 'resolved', 'acknowledged'])->default('pending'); // Enum for status with a default
            $table->datetime('reported_at');
            $table->datetime('resolved_at')->nullable();  // Allow for null resolved_at if not yet resolved
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};

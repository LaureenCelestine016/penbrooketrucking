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
        Schema::create('maintenance_tasks', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->unsignedBigInteger('vehicle_id')->nullable();
            $table->unsignedBigInteger('trailer_id')->nullable();
            $table->string('item_description');
            $table->integer('quantity');
            $table->string('unit');
            $table->decimal('price', 10, 2);
            $table->decimal('total', 10, 2);
            $table->string('odometer')->nullable();
            $table->string('supplier');
            $table->string('ref_no');
            $table->string('remarks')->nullable();
            $table->date('breakdown_date');
            $table->date('up_date');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maintenance_tasks');
    }
};

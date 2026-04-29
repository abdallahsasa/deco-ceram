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
        Schema::create('sizes', function (Blueprint $table) {
            $table->string('id')->primary(); // e.g., '60x60-9mm'
            $table->string('name'); // e.g., '60x60 cm'
            $table->string('dimensions')->nullable();
            $table->string('thickness')->nullable();
            
            // Packaging info
            $table->integer('pcs_per_box')->default(1);
            $table->decimal('sqm_per_box', 8, 4)->nullable();
            $table->decimal('kg_per_box', 8, 2)->nullable();
            $table->integer('boxes_per_pallet')->nullable();
            $table->decimal('sqm_per_pallet', 10, 4)->nullable();
            $table->decimal('kg_per_pallet', 10, 2)->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sizes');
    }
};

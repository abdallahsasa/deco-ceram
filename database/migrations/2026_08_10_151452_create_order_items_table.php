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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->cascadeOnDelete();
            $table->string('product_id');
            $table->string('variant_name')->nullable();
            $table->decimal('meters', 10, 2)->nullable();
            $table->decimal('quantity', 10, 2)->nullable();
            $table->integer('boxes')->nullable();
            $table->integer('pcs')->nullable();
            $table->integer('pcs_per_box')->nullable();
            $table->decimal('sqm_per_box', 10, 4)->nullable();
            $table->decimal('price', 10, 2)->default(0); // Price of the item at the time of purchase
            $table->decimal('total', 10, 2)->default(0); // quantity * price (or boxes * price depending on unit)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};

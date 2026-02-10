<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('name');
            $table->string('category_id');
            $table->string('material')->nullable();
            $table->string('finish')->nullable();
            $table->string('size')->nullable();
            $table->string('thickness')->nullable();
            $table->string('look')->nullable();
            $table->string('color')->nullable();
            $table->string('collection')->nullable();
            $table->text('description')->nullable();
            $table->json('applications')->nullable();
            $table->json('images')->nullable();
            $table->boolean('featured')->default(false);
            $table->string('price_range')->nullable();
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};

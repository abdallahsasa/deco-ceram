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
        try {
            Schema::table('collections', function (Blueprint $table) {
                $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade')->onUpdate('cascade');
            });
        } catch (\Exception $e) {}

        try {
            Schema::table('products', function (Blueprint $table) {
                $table->string('category_id')->nullable()->change();
            });
        } catch (\Exception $e) {}

        try {
            Schema::table('products', function (Blueprint $table) {
                $table->foreign('collection_id')->references('id')->on('collections')->onDelete('cascade')->onUpdate('cascade');
            });
        } catch (\Exception $e) {}

        try {
            Schema::table('products', function (Blueprint $table) {
                $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null')->onUpdate('cascade');
            });
        } catch (\Exception $e) {}

        try {
            Schema::table('variants', function (Blueprint $table) {
                $table->string('size_id')->nullable()->change();
            });
        } catch (\Exception $e) {}

        try {
            Schema::table('variants', function (Blueprint $table) {
                $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade')->onUpdate('cascade');
            });
        } catch (\Exception $e) {}

        try {
            Schema::table('variants', function (Blueprint $table) {
                $table->foreign('size_id')->references('id')->on('sizes')->onDelete('set null')->onUpdate('cascade');
            });
        } catch (\Exception $e) {}

        try {
            Schema::table('project_product', function (Blueprint $table) {
                $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade')->onUpdate('cascade');
            });
        } catch (\Exception $e) {}

        try {
            Schema::table('project_product', function (Blueprint $table) {
                $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade')->onUpdate('cascade');
            });
        } catch (\Exception $e) {}
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Reverting would involve dropping and recreating without onUpdate('cascade')
        // But since onUpdate('cascade') is generally better for string IDs, we'll keep it simple
    }
};

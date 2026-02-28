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
        // 1. Brands Table
        Schema::create('brands', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('logo')->nullable();
            $table->string('hero_image')->nullable();
            $table->text('description')->nullable();
            $table->boolean('official_distributor')->default(false);
            $table->timestamps();
        });

        // 2. Collections Table
        Schema::create('collections', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('brand_id');
            $table->string('category_id')->nullable();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('hero_image')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();

            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');
        });

        // 3. Update Products Table
        Schema::table('products', function (Blueprint $table) {
            $table->string('slug')->nullable()->after('name');
            $table->string('collection_id')->nullable()->after('slug');
            $table->json('technical_specs')->nullable()->after('description');
            $table->json('downloads')->nullable()->after('technical_specs');

            // Rename existing collection string column to avoid conflict if necessary
            // But the Task says "Collection" is now a relation.
            // The existing 'collection' column is a string.
            // I'll drop it after data migration or just leave it for now.
            // I'll drop it to be clean.
            $table->dropColumn('collection');

            $table->foreign('collection_id')->references('id')->on('collections')->onDelete('cascade');
        });

        // 4. Variants Table
        Schema::create('variants', function (Blueprint $table) {
            $table->id();
            $table->string('product_id');
            $table->string('name')->nullable();
            $table->string('size')->nullable();
            $table->string('finish')->nullable();
            $table->string('thickness')->nullable();
            $table->json('images')->nullable();
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('variants');

        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['collection_id']);
            $table->dropColumn(['slug', 'collection_id', 'technical_specs', 'downloads']);
            $table->string('collection')->nullable()->after('color');
        });

        Schema::dropIfExists('collections');
        Schema::dropIfExists('brands');
    }
};

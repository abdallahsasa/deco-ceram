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
        Schema::table('variants', function (Blueprint $table) {
            $table->string('size_id')->nullable()->after('product_id');
            $table->string('sku')->nullable()->after('size_id');
            $table->decimal('price_full_pallet', 10, 2)->nullable()->after('sku');
            $table->decimal('price_partial_pallet', 10, 2)->nullable()->after('price_full_pallet');
            $table->string('finish_type')->nullable()->after('price_partial_pallet');
            $table->boolean('is_active')->default(true)->after('finish_type');
            
            // Link to sizes
            $table->foreign('size_id')->references('id')->on('sizes')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('variants', function (Blueprint $table) {
            $table->dropForeign(['size_id']);
            $table->dropColumn([
                'size_id',
                'sku',
                'price_full_pallet',
                'price_partial_pallet',
                'finish_type',
                'is_active'
            ]);
        });
    }
};

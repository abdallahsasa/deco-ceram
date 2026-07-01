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
        Schema::table('quote_request_items', function (Blueprint $table) {
            $table->integer('boxes')->nullable()->after('meters');
            $table->integer('pcs')->nullable()->after('boxes');
            $table->integer('pcs_per_box')->nullable()->after('pcs');
            $table->decimal('sqm_per_box', 10, 4)->nullable()->after('pcs_per_box');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('quote_request_items', function (Blueprint $table) {
            $table->dropColumn(['boxes', 'pcs', 'pcs_per_box', 'sqm_per_box']);
        });
    }
};

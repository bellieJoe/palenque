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
        Schema::table('ambulant_stalls', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('app_features', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('app_settings', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('contract_settings', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('deliveries', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('delivery_items', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('delivery_tickets', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('fees', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('fee_settings', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('items', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('item_categories', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('item_fee_settings', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('item_tax_rates', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('monthly_rents', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('municipal_markets', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('origins', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('price_monitoring_records', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('roles', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('role_presets', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('stalls', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('stall_rates', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('suppliers', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('units', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('users', function (Blueprint $table) {
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ambulant_stalls', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('app_features', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('app_settings', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('contract_settings', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('deliveries', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('delivery_items', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('delivery_tickets', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('fees', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('fee_settings', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('items', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('item_categories', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('item_fee_settings', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('item_tax_rates', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('monthly_rents', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('municipal_markets', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('origins', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('price_monitoring_records', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('roles', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('role_presets', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('stalls', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('stall_rates', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('suppliers', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('units', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('users', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }

};

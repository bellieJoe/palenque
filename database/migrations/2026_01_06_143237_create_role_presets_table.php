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
        Schema::create('role_presets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('role_type_id');
            $table->foreignId('municipal_market_id');
            $table->boolean("data_entry_wet_dry_goods_deliveries")->default(false);
            $table->boolean("data_entry_wet_dry_goods_price_monitoring")->default(false);
            $table->boolean("data_entry_violation_violations")->default(false);
            $table->boolean("data_entry_fees_collection_ambulants")->default(false);
            $table->boolean("data_entry_fees_collection_monthly_rents")->default(false);
            $table->boolean("maintenance_suppliers")->default(false);
            $table->boolean("maintenance_vendors")->default(false);
            $table->boolean("maintenance_stall_management_ambulants")->default(false);
            $table->boolean("maintenance_stall_management_stalls")->default(false);
            $table->boolean("maintenance_stall_management_stall_rates")->default(false);
            $table->boolean("maintenance_wet_dry_goods_items")->default(false);
            $table->boolean("maintenance_wet_dry_goods_categories")->default(false);
            $table->boolean("maintenance_wet_dry_goods_units")->default(false);
            $table->boolean("maintenance_violation_types")->default(false);
            $table->boolean("maintenance_fees_ambulants")->default(false);
            $table->boolean("maintenance_fees_tax_rate")->default(false);
            $table->boolean("reports")->default(false);
            $table->boolean("app_settings")->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('role_presets');
    }
};

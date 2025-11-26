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
        Schema::create('price_monitoring_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('item_id');
            $table->foreignId('unit_id');
            $table->double('price');
            $table->foreignId('municipal_market_id');
            $table->foreignId('user_id');
            $table->date('date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('price_monitoring_records');
    }
};

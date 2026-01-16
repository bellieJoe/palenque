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
        Schema::create('vendor_prices', function (Blueprint $table) {
            $table->id();
            $table->integer('vendor_id');
            $table->integer('item_id');
            $table->double('price');
            $table->date('date');
            $table->foreignId('municipal_market_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendor_prices');
    }
};

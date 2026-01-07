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
        Schema::create('contract_settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('municipal_market_id');
            $table->string("municipality_name", 255);
            $table->string("mayors_name", 100);
            $table->string("address", 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contract_settings');
    }
};

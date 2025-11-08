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
        Schema::create('violations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('stall_occupant_id');
            $table->foreignId('vendor_id');
            $table->foreignId('violation_type_id');
            $table->enum('status', ['COMPLETED', 'PENDING', 'WAIVED'])->default('pending');
            $table->foreignId('municipal_market_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('violations');
    }
};

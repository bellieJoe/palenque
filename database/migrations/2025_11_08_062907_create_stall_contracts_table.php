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
        Schema::create('stall_contracts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('stall_occupant_id');
            $table->date('from');
            $table->date('to');
            $table->foreignId('stall_rate_id'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stall_contracts');
    }
};

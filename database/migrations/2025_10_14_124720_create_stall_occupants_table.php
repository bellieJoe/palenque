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
        Schema::create('stall_occupants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('stall_id');
            $table->foreignId('vendor_id');
            $table->date('date_occupied');
            $table->date('date_left')->nullable();
            $table->boolean('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stall_occupants');
    }
};

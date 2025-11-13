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
        Schema::create('fees', function (Blueprint $table) {
            $table->id();
            $table->string('ticket_no', 20)->unique();
            $table->integer('no');
            $table->foreignId('owner_id');
            $table->foreignId("municipal_market_id");
            $table->enum('fee_type', ['SUPPLIER', 'STALL']);
            $table->double('amount');
            $table->string('remarks', 5000)->nullable();
            $table->date('date_paid')->nullable();
            $table->string('receipt_no')->nullable();
            $table->enum('status', ['PAID', 'UNPAID', 'WAIVED'])->default('UNPAID');
            $table->date('date_issued');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fees');
    }
};

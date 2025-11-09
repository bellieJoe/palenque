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
        Schema::create('delivery_tickets', function (Blueprint $table) {
            $table->id();
            $table->foreignId("delivery_item_id");
            $table->foreignId("municipal_market_id");
            $table->double("amount");
            $table->enum("status", ["PAID", "UNPAID", "WAIVED"])->default("UNPAID");
            $table->string("receipt_no")->nullable();
            $table->date("date_issued");
            $table->date("date_paid");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delivery_tickets');
    }
};

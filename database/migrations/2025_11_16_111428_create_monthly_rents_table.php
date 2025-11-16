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
        Schema::create('monthly_rents', function (Blueprint $table) {
            $table->id();
            $table->foreignId("municipal_market_id");
            $table->foreignId("stall_contract_id");
            $table->double("amount");   
            $table->date("payment_date")->nullable();
            $table->date("bill_date");
            $table->date("due_date");
            $table->enum('status', ['PAID', 'UNPAID', 'WAIVED'])->default('UNPAID');
            $table->json("payment_json")->nullable();
            $table->enum('payment_method', ['CASH', 'ONLINE'])->default('CASH');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('monthly_rents');
    }
};

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
        Schema::table('stalls', function (Blueprint $table) {
            //
            $table->enum('product_type', ['WET', 'DRY'])->nullable()->after('name');
            $table->string('location')->nullable()->after('name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('stalls', function (Blueprint $table) {
            //
            $table->dropColumn('product_type');
            $table->dropColumn('location');
        });
    }
};

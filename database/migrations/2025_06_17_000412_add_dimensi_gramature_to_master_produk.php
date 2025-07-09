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
        Schema::table('master_produk', function (Blueprint $table) {
        $table->decimal('gramature_min', 8, 2)->nullable();
        $table->decimal('gramature_standar', 8, 2)->nullable();
        $table->decimal('gramature_max', 8, 2)->nullable();
        $table->decimal('dimensi_panjang', 8, 2)->nullable();
        $table->decimal('dimensi_lebar', 8, 2)->nullable();
        $table->decimal('dimensi_tinggi', 8, 2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('master_produk', function (Blueprint $table) {
            //
        });
    }
};

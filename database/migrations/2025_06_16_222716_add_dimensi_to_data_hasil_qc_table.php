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
        Schema::table('data_hasil_qc', function (Blueprint $table) {
            $table->float('dimensi_panjang')->nullable();
        $table->float('dimensi_lebar')->nullable();
        $table->float('dimensi_tinggi')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('data_hasil_qc', function (Blueprint $table) {
            $table->dropColumn(['dimensi_panjang', 'dimensi_lebar', 'dimensi_tinggi']);
        });
    }
};

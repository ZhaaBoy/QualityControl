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
        
        Schema::create('master_produk', function (Blueprint $table) {
            $table->id('id');
            $table->string('customer')->nullable();
            $table->string('kode_barang')->nullable();
            $table->string('nama_produk')->nullable();
            $table->string('bahan')->nullable();
            $table->string('tebal_bahan')->nullable();
            $table->integer('gramature_min')->nullable();
            $table->integer('gramature_standar')->nullable();
            $table->integer('gramature_max')->nullable();

            $table->integer('dimensi_panjang')->nullable();
            $table->integer('dimensi_lebar')->nullable();
            $table->integer('dimensi_tinggi')->nullable();
            $table->timestamps();
        });

        Schema::create('laporan_hasil_produksi', function (Blueprint $table) {
            $table->id('id');
            $table->string('hari')->nullable();
            $table->timestamp('tanggal')->nullable();
            $table->string('mesin')->nullable();
            $table->string('nama_operator')->nullable();
            $table->string('nama_produk')->nullable();
            $table->string('acuan_sampling')->nullable();
            $table->string('aql_check')->nullable();
            $table->string('status_produk')->nullable();
            $table->string('temuan_defect')->nullable();
            $table->timestamps();
        });

        Schema::create('kelola_permasalahan', function (Blueprint $table) {
            $table->id('id');
            $table->time('jam')->nullable();
            $table->string('mesin')->nullable();
            $table->string('nama_operator')->nullable();
            $table->string('nama_produk')->nullable();
            $table->string('penyebab')->nullable();
            $table->string('permasalahan')->nullable();
            $table->string('inline')->nullable();
            $table->string('foto')->nullable();
            $table->timestamps();
        });

        Schema::create('data_hasil_produksi', function (Blueprint $table) {
            $table->id('id');
            $table->string('hari')->nullable();
            $table->string('tanggal')->nullable();
            $table->string('mesin')->nullable();
            $table->integer('nama_produk')->nullable();
            $table->string('jenis_bahan')->nullable();
            $table->string('acuan_sampling')->nullable();
            $table->string('aql_check')->nullable();
            $table->string('status_pre_order')->nullable();
            $table->date('tanggal_start_awal')->nullable();
            $table->timestamps();
        });

         Schema::create('data_hasil_qc', function (Blueprint $table) {
            $table->id('id');
            $table->string('hari')->nullable();
            $table->string('tanggal')->nullable();
            $table->string('nama_produk')->nullable();
            $table->string('nama_mesin')->nullable();
            $table->string('jumlah_cavity')->nullable();
            $table->string('jenis_bahan')->nullable();
            $table->string('tebal_bahan')->nullable();
            $table->string('status_pre')->nullable();
            $table->integer('dimensi_panjang')->nullable();
            $table->integer('dimensi_lebar')->nullable();
            $table->integer('dimensi_tinggi')->nullable();
            $table->string('aql_check')->nullable();
            $table->string('inline')->nullable();
            $table->string('point_critical')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_produk');
        Schema::dropIfExists('laporan_hasil_produksi');
        Schema::dropIfExists('kelola_permasalahan');
        Schema::dropIfExists('data_hasil_produksi');
        Schema::dropIfExists('data_hasil_qc');
    }
};

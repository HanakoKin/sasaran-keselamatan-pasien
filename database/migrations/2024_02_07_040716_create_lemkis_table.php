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
        Schema::create('lemkis', function (Blueprint $table) {
            $table->id();

            /* DATA LEMKIS */
            $table->foreignId('lapin_id')->constrained();
            $table->string('unit_kerja');

            $table->text('penyebab_langsung');
            $table->text('penyebab_awal');
            $table->text('rekom_invest_pendek')->nullable();
            $table->string('penanggung_rekom_pendek')->nullable();
            $table->date('tanggal_rekom_pendek')->nullable();
            $table->text('rekom_invest_menengah')->nullable();
            $table->string('penanggung_rekom_menengah')->nullable();
            $table->date('tanggal_rekom_menengah')->nullable();
            $table->text('rekom_invest_panjang')->nullable();
            $table->string('penanggung_rekom_panjang')->nullable();
            $table->date('tanggal_rekom_panjang')->nullable();
            $table->text('realisasi_invest_pendek')->nullable();
            $table->string('penanggung_realisasi_pendek')->nullable();
            $table->date('tanggal_realisasi_pendek')->nullable();
            $table->text('realisasi_invest_menengah')->nullable();
            $table->string('penanggung_realisasi_menengah')->nullable();
            $table->date('tanggal_realisasi_menengah')->nullable();
            $table->text('realisasi_invest_panjang')->nullable();
            $table->string('penanggung_realisasi_panjang')->nullable();
            $table->date('tanggal_realisasi_panjang')->nullable();
            $table->string('nama_pelengkap');
            $table->text('ttd_pelengkap');
            $table->string('bagian_pelengkap');
            $table->date('tanggal_mulai_invest');
            $table->date('tanggal_dilengkapi');
            $table->date('tanggal_informasi');
            $table->string('direksi')->nullable();
            $table->string('asdir')->nullable();
            $table->string('timkes')->nullable();
            $table->string('personalia')->nullable();
            $table->string('invest_lengkap');
            $table->date('tanggal_pengesahan');
            $table->string('invest_lanjut');
            $table->string('grading_akhir');

            $table->text('catatan')->nullable();
            $table->text('tanggal_catatan')->nullable();
            $table->text('narasumber')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lemkis');
    }
};

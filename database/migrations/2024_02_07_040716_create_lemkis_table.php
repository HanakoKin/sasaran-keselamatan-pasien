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
            $table->string('penyebab_langsung');
            $table->string('penyebab_awal');
            $table->string('rekom_invest_pendek');
            $table->string('penanggung_rekom_pendek')->nullable();
            $table->date('tanggal_rekom_pendek')->nullable();
            $table->string('rekom_invest_menengah')->nullable();
            $table->string('penanggung_rekom_menengah')->nullable();
            $table->date('tanggal_rekom_menengah')->nullable();
            $table->string('rekom_invest_panjang')->nullable();
            $table->string('penanggung_rekom_panjang')->nullable();
            $table->date('tanggal_rekom_panjang')->nullable();
            $table->string('realisasi_invest_pendek')->nullable();
            $table->string('penanggung_realisasi_pendek')->nullable();
            $table->date('tanggal_realisasi_pendek')->nullable();
            $table->string('realisasi_invest_menengah')->nullable();
            $table->string('penanggung_realisasi_menengah')->nullable();
            $table->date('tanggal_realisasi_menengah')->nullable();
            $table->string('realisasi_invest_panjang')->nullable();
            $table->string('penanggung_realisasi_panjang')->nullable();
            $table->date('tanggal_realisasi_panjang')->nullable();
            $table->string('ttd_pelengkap');
            $table->string('nama_pelengkap');
            $table->string('bagian_pelengkap');
            $table->date('tanggal_mulai_invest');
            $table->date('tanggal_dilengkapi');
            $table->date('tanggal_informasi');
            $table->string('direksi');
            $table->string('asdir');
            $table->string('timkes');
            $table->string('personalia');
            $table->string('invest_lengkap');
            $table->date('tanggal_pengesahan');
            $table->string('invest_lanjut');
            $table->string('grading_akhir');

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

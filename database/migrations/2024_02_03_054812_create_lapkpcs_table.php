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
        Schema::create('lapkpcs', function (Blueprint $table) {
            $table->id();
            $table->string('kpc');
            $table->date('tanggal_ditemukan');
            $table->time('jam_ditemukan');
            $table->string('pelapor_insiden');
            $table->string('tempat_insiden');
            $table->string('unit_insiden');
            $table->string('tindakan_cepat');
            $table->string('tindakan_insiden');
            $table->string('kejadian_insiden');

            /* KETERANGAN LAPORAN */

            $table->string('status');
            $table->string('pembuat_laporan')->nullable();
            $table->string('penerima_laporan')->nullable();
            $table->string('tanggal_terima')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lapkpcs');
    }
};

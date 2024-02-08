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
        Schema::create('lapins', function (Blueprint $table) {
            $table->id();

            /* DATA PASIEN */
            $table->string('nama');
            $table->string('noRM')->unique();
            $table->string('ruangan');
            $table->string('umur');
            $table->string('jenis_kelamin');
            $table->string('penjamin');
            $table->date('tanggal_masuk');
            $table->time('jam_masuk');

            /* DATA LAPORAN INSIDEN */
            $table->date('tanggal_kejadian');
            $table->time('jam_kejadian');
            $table->string('insiden');
            $table->text('kronologis');
            $table->string('jenis_insiden');
            $table->string('pelapor_insiden');
            $table->string('korban_insiden');
            $table->string('layanan_insiden');
            $table->string('tempat_insiden');
            $table->string('kasus_insiden');
            $table->string('unit_insiden');
            $table->string('dampak_insiden');
            $table->string('tindakan_cepat');
            $table->string('tindakan_insiden');
            $table->string('kejadian_insiden');

            /* KETERANGAN LAPORAN */

            $table->string('status');
            $table->string('pembuat_laporan')->nullable();
            $table->string('penerima_laporan')->nullable();
            $table->string('tanggal_terima')->nullable();
            $table->string('grading_risiko')->nullable();


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lapins');
    }
};

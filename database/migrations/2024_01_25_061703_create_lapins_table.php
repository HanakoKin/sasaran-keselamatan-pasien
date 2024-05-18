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

            $table->string('unit_kerja');

            /* DATA PASIEN */
            $table->string('nama');
            $table->string('noReg');
            $table->string('noRM');
            $table->string('ruangan');
            $table->string('umur');
            $table->string('jenis_kelamin');
            $table->date('tanggal_lahir');
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
            $table->text('tindakan_cepat');
            $table->string('tindakan_insiden');
            $table->text('kejadian_insiden');
            $table->string('status_pelapor');

            /* KETERANGAN LAPORAN */
            $table->string('status');
            $table->string('pembuat_laporan');
            $table->text('paraf_pelapor');
            $table->string('penerima_laporan')->nullable();
            $table->text('paraf_penerima')->nullable();
            $table->string('tanggal_terima')->nullable();
            $table->string('grading_risiko')->nullable();

            /* STATUS PROSES EDIT */
            $table->boolean('proses_edit')->default(false);

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

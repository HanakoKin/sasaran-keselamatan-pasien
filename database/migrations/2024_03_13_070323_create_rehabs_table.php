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
        Schema::create('rehabs', function (Blueprint $table) {
            $table->id();
<<<<<<< HEAD
            $table->string('unit');
=======
>>>>>>> 7c2d4dfe7f8bfcdfc157e24f4a8030acce77ba28
            $table->string('bulan');
            $table->string('tahun');
            $table->string('jml_hari');
            $table->text('sensus');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rehabs');
    }
};

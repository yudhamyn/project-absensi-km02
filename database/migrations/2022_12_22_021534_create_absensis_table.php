<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbsensisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('absensi', function (Blueprint $table) {
            $table->id();
            $table->string('kode_absensi')->unique();
            $table->integer('jumlah_pegawai');
            $table->integer('jumlah_pegawai_masuk');
            $table->integer('jumlah_pegawai_pulang');
            $table->integer('jumlah_izin');
            $table->integer('total');
            $table->string('tgl_absen');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('absensi');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbsensiDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('absensi_detail', function (Blueprint $table) {
            $table->id();
            $table->string('kode_absensi');
            $table->integer('pegawai_id');
            $table->integer('absen_masuk')->nullable();
            $table->integer('status_masuk')->nullable();
            $table->string('latitude_masuk')->nullable();
            $table->string('longitude_masuk')->nullable();
            $table->integer('absen_pulang')->nullable();
            $table->integer('status_pulang')->nullable();
            $table->string('latitude_pulang')->nullable();
            $table->string('longitude_pulang')->nullable();
            $table->integer('izin')->nullable();
            $table->integer('status_izin')->nullable();
            $table->longText('alasan')->nullable();
            $table->string('bukti_izin')->nullable();
            $table->string('bukti_masuk')->nullable();
            $table->string('bukti_pulang')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('absensi_detail');
    }
}

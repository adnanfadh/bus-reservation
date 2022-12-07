<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenjadwalan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penjadwalan', function (Blueprint $table) {
            $table->id();
            $table->enum('jenis_jadwal',['Booking', 'Service']);
            $table->integer('id_booking')->nullable();
            $table->integer('id_unit')->nullable();
            $table->string('id_supir')->nullable();
            $table->integer('id_crew')->nullable();
            $table->integer('durasi')->nullable();
            $table->date('tgl_jadwal')->nullable();
            $table->enum('status_jadwal',['Pending','Proses', 'Selesai','Batal']);
            $table->string('jam_standby',20)->nullable();
            $table->text('rute')->nullable();
            $table->string('catatan')->nullable();
            $table->string('bahan_bakar')->nullable();
            $table->string('premi_supir')->nullable();
            $table->string('premi_helper')->nullable();
            $table->string('potongan_supir')->nullable();
            $table->string('potongan_helper')->nullable();
            $table->string('kas_tabungan')->nullable();
            $table->integer('total_kas_keluar')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('penjadwalan');
    }
}

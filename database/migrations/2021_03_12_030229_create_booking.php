<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooking extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking', function (Blueprint $table) {
            $table->id();
            $table->date('tgl_booking');
            $table->integer('lama_booking');
            $table->enum('jenis_booking', ['Mitra', 'User Publish']);
            $table->integer('id_kostumer')->nullable();
            $table->string('nama_kostumer')->nullable();
            $table->text('alamat_kostumer')->nullable();
            $table->string('telp_kostumer')->nullable();
            $table->integer('id_mitra')->nullable();
            $table->string('id_tipe');
            $table->string('id_hargatujuan');
            $table->integer('harga_nominal');
            $table->integer('qty');
            $table->string('sub_total')->nullable();;
            $table->integer('total')->nullable();;
            $table->string('metode_bayar');
            $table->string('bukti_bayar')->nullable();;
            $table->enum('status_booking',['Sukses', 'Pending', 'Cancel'])->comment('Pending');
            $table->string('alamat_jemput')->nullable();;
            $table->text('keterangan')->nullable();;
            $table->integer('id_karyawan');
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
        Schema::dropIfExists('booking');
    }
}

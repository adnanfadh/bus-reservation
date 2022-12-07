<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMitra extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mitra', function (Blueprint $table) {
            $table->id();
            $table->string('nama_mitra',100);
            $table->string('penanggung_jawab',5);
            $table->text('alamat_mitra');
            $table->string('no_telp_mitra',15);
            $table->string('email_mitra',100);
            $table->text('keterangan');
            $table->enum('kemitraan',['Pool Bis', 'Travel Agent', 'Owner']);
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
        Schema::dropIfExists('mitra');
    }
}

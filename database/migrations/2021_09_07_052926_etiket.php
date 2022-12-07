<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Etiket extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('etiket', function (Blueprint $table) {
            $table->id();
            $table->string('nama_etiket');
            $table->string('kontingen_etiket');
            $table->string('hari_etiket');
            $table->date('tgl_etiket');
            $table->string('jam_etiket');
            $table->string('id_tipe');
            $table->string('id_hargatujuan');
            $table->text('alamat_jemput');
            $table->text('keterangan_etiket')->nullable();
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
        Schema::dropIfExists('etiket');
    }
}

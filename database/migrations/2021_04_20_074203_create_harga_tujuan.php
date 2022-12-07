<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHargaTujuan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('harga_tujuan', function (Blueprint $table) {
            $table->id();
            $table->integer('id_tipe');
            $table->integer('idTujuan_awal');
            $table->integer('idTujuan_akhir');
            $table->integer('min_hari');
            $table->integer('harga');
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
        Schema::dropIfExists('harga_tujuan');
    }
}

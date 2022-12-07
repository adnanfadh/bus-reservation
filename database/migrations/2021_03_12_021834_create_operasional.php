<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOperasional extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('operasional', function (Blueprint $table) {
            $table->id();
            $table->integer('id_jadwal');
            $table->enum('jenis_opr',['Service', 'Storing']);
            $table->string('item');
            $table->string('harga');
            $table->string('qty');
            $table->string('sub_total');
            $table->text('keterangan')->nullable();
            $table->integer('total')->nullable();
            $table->string('mekanik')->nullable();
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
        Schema::dropIfExists('operasional');
    }
}

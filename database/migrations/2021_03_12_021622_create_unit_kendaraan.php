<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnitKendaraan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unit_kendaraan', function (Blueprint $table) {
            $table->id();
            $table->string('nama_unit',50);
            $table->integer('id_tipe');
            $table->integer('jumlah_seats')->nullable();
            $table->string('no_ap',10)->nullable();
            $table->integer('no_rangka')->nullable();
            $table->string('no_plat',10)->nullable();
            $table->string('no_uji',15)->nullable();
            $table->string('no_lambung',10)->nullable();
            $table->date('masa_berlaku_stnk')->nullable();
            $table->date('masa_berlaku_pajak')->nullable();
            $table->date('masa_berlaku_kir')->nullable();
            $table->string('kode_gps',25)->nullable();
            $table->integer('jarak_perjalanan')->nullable();
            $table->integer('id_supir')->nullable();
            $table->enum('status_unit',['Tersedia', 'Tidak Tersedia', 'Perbaikan'])->comment('Tersedia');
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
        Schema::dropIfExists('unit_kendaraan');
    }
}

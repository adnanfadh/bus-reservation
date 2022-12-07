<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengajuanDana extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengajuan_dana', function (Blueprint $table) {
            $table->id();
            $table->date('tgl_pengajuan');
            $table->string('nama_pengajuan');
            $table->text('rincian_pengajuan');
            $table->integer('nominal');
            $table->enum('status',['Disetujui', 'Pending', 'Tidak Disetujui', 'Perbaiki'])->comment('Pending');
            $table->integer('id_karyawan');
            $table->date('tgl_konfirmasi')->nullable();
            $table->integer('id_karyawan_konfir')->nullable();
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
        Schema::dropIfExists('pengajuan_dana');
    }
}

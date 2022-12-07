<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKaryawan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('karyawan', function (Blueprint $table) {
            $table->id();
            $table->integer('id_users');
            $table->string('nip');
            $table->enum('jabatan',['Administrator', 'Admin Office','Admin Keuangan', 'Admin Pool','Marketing','Supir']);
            $table->string('foto')->nullable();
            $table->enum('status',['Aktif', 'Non-Aktif', 'Dinas', 'Izin', 'Sakit', 'Cuti', 'Libur']);
            $table->integer('id_unit')->nullable();
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
        Schema::dropIfExists('karyawan');
    }
}

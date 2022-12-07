<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class tipeKendSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipe_kendaraan')->insert([
            [
                'nama_tipe' => 'Hiace',
                'merk' => 'Toyota',
                'seats' => 14,
                'fasilitas' => 'AC',
                'harga_tipe' => 750000,
            ], [
                'nama_tipe' => 'Hiace Executive',
                'merk' => 'Toyota',
                'seats' => 8,
                'fasilitas' => 'AC',
                'harga_tipe' => 750000,
            ], [
                'nama_tipe' => 'Medium Bus',
                'merk' => 'Mercedess',
                'seats' => 35,
                'fasilitas' => 'AC',
                'harga_tipe' => 2500000,
            ], [
                'nama_tipe' => 'Big Bus',
                'merk' => 'Mercedess',
                'seats' => 50,
                'fasilitas' => 'AC',
                'harga_tipe' => 3600000,
            ], [
                'nama_tipe' => 'Big Bus',
                'merk' => 'Mercedess',
                'seats' => 59,
                'fasilitas' => 'AC',
                'harga_tipe' => 3800000,
            ],
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TujuanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tujuan')->insert([
            [
              'id'  => 1,
              'nama_tujuan' => 'Bandung',
            ],
            [
                'id'  => 2,
                'nama_tujuan' => 'Jakarta',
            ],
            [
                'id'  => 3,
                'nama_tujuan' => 'Yogya',
            ],
            [
                'id'  => 4,
                'nama_tujuan' => 'Bali',
            ],
        ]);
    }
}

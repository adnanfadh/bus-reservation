<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class usersProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users_profile')->insert([
            [
                'nama' => 'Administrator',
                'alamat' => 'Leuwisar1',
                'telp' => '0000000000',
            ], [
                'nama' => 'Adnan Fadhillah',
                'alamat' => 'Jl. Kawali',
                'telp' => '089657136025',
            ], [
                'nama' => 'M.Ridwan',
                'alamat' => 'Jl. Soreang',
                'telp' => '080000',
            ], [
                'nama' => 'Vinny',
                'alamat' => 'Jl. ',
                'telp' => '080000',
            ], [
                'nama' => 'Papap',
                'alamat' => 'Jl. ',
                'telp' => '080000',
            ], [
                'nama' => 'Zidan',
                'alamat' => 'Jl. ',
                'telp' => '080000',
            ],[
                'nama' => 'Habib',
                'alamat' => 'Jl. ',
                'telp' => '080000',
            ],
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class userSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $administrator = User::Create([
            'id_profile' => '1',
            'email' => 'admin@drw-trans.com',
            'password' => Hash::make('admin123'),
            'akses' => 'Karyawan',
            'id_role' => '1',
        ]);
        $administrator->assignRole('Administrator');

        $admin2 = User::Create([
            'id_profile' => '2',
            'email' => 'adnan@drw-trans.com',
            'password' => Hash::make('admin123'),
            'akses' => 'Karyawan',
            'id_role' => '1',
        ]);
        $admin2->assignRole(['Administrator', 'Admin_Office']);

        $office = User::Create([
        'id_profile' => '3',
            'email' => 'ridwan@drw-trans.com',
            'password' => Hash::make('123456789'),
            'akses' => 'Karyawan',
            'id_role' => '2',
        ]);
        $office->assignRole('Admin_Office');

        $keuangan = User::Create([
        'id_profile' => '4',
            'email' => 'vinny@drw-trans.com',
            'password' => Hash::make('123456789'),
            'akses' => 'Karyawan',
            'id_role' => '4',
        ]);
        $keuangan->assignRole('Admin_Keuangan');

        $pool = User::Create([
            'id_profile' => '5',
            'email' => 'papap@drw-trans.com',
            'password' => Hash::make('123456789'),
            'akses' => 'Karyawan',
            'id_role' => '4',
        ]);
        $pool->assignRole('Admin_Pool');

        $market = User::Create([
            'id_profile' => '6',
            'email' => 'zidan@drw-trans.com',
            'password' => Hash::make('123456789'),
            'akses' => 'Karyawan',
            'id_role' => '5',
        ]);
        $market->assignRole('Marketing');

        $supir = User::Create([
            'id_profile' => '7',
            'email' => 'habib@drw-trans.com',
            'password' => Hash::make('123456789'),
            'akses' => 'Karyawan',
            'id_role' => '6',
        ]);
        $supir->assignRole('Supir');
    }
}

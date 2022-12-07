<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
//use Spatie\Permission\Models\Role;


class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Role::create();
        DB::table('role')->insert([
            [
                'id'  => 1,
                'role' => 'Administrator'
            ],
            [
                'id'  => 2,
                'role' => 'Admin Office'
            ],
            [
                'id'  => 3,
                'role' => 'Admin Keuangan'
            ],
            [
                'id'  => 4,
                'role' => 'Admin Pool'
            ],
            [
                'id'  => 5,
                'role' => 'Marketing'
            ],
            [
                'id'  => 6,
                'role' => 'Supir'
            ],
            ]);
    }
}

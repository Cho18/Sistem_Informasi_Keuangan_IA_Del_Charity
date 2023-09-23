<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'role_name' => 'Admin',
                'role_description' => null,
            ],
            [
                'role_name' => 'BPH',
                'role_description' => null,
            ],
            [
                'role_name' => 'Donator',
                'role_description' => null,
            ],
            [
                'role_name' => 'Awardee',
                'role_description' => null,
            ],
        ];

        // Insert data into the roles table
        DB::table('roles')->insert($roles);
    }
}

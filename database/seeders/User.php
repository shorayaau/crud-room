<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class User extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array(
            [
                'nama' => 'admin',
                'username' => 'admin',
                'password' => Hash::make('123456'),
                'level' => 'admin'
            ], [
                'nama' => 'user',
                'username' => 'user',
                'password' => Hash::make('123456'),
                'level' => 'user'
            ]
        );
        DB::table('users')->insert($data);
    }
}

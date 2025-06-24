<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            [
                'username' => 'Tanaka taro',
                'mail' => 'tanaka@example.com',
                'password' => Hash::make('passwordT123'),
            ],

            [
                'username' => 'Sato taro',
                'mail' => 'sato@example.com',
                'password' => Hash::make('passwordS123'),
            ],

            [
                'username' => 'Ito taro',
                'mail' => 'ito@example.com',
                'password' => Hash::make('passwordI123'),
            ]
        ]);
    }
}

<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class User extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name'              => 'Admin User',
                'email'             => 'admin@gmail.com',
                'image'             => 'default.png',
                'role'              => 'admin',
                'password'          => Hash::make('password123'),
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
            [
                'name'              => 'Customer User',
                'email'             => 'user@gmail.com',
                'image'             => 'default.png',
                'role'              => 'user',
                'password'          => Hash::make('password123'),
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
        ]);
    }
}

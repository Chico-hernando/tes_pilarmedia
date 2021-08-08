<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();

        DB::table('users')->insert([[
            'name' => "User pertama",
            'email' => 'userPertama@gmail.com',
            'role' => 1,
            'password' => Hash::make('123456'),
            'created_at' => now()
        ],[
            'name' => "User manager",
            'email' => 'userManager@gmail.com',
            'role' => 2,
            'password' => Hash::make('123456'),
            'created_at' => now()
        ]

        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\facades\DB;
use Illuminate\Support\Str;
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
        DB::table('users')->insert([
            'name' => 'monza',
            'email' => 'monza@monza.com',
            'email_verified_at' => now(),
            'remember_token'    => Str::random(10),
            'password' => Hash::make('monza@monza.com')
        ]);
    }
}

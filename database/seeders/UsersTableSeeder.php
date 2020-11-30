<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'tony_admin',
            'email' => 'tony_admin@laravel.com',
            'password' => Hash::make('admin'),
        ]);
    }
}

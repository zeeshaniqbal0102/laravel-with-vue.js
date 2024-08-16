<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        User::create([
            'username' => 'admin',
            'first_name' => 'Demo',
            'last_name' => 'User',
            'email' => 'admin@example.com',
            'password' => '123456'
        ]);
    }
}

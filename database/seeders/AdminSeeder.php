<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            ['name' => 'Admin Deo', 'phone' => '0', 'role' => USER_ROLE_ADMIN, 'email' => 'admin@gmail.com', 'password' => Hash::make(123456)],
        ]);
    }
}

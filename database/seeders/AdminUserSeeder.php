<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = [
            [
                'email' => 'vudat1328@gmail.com',
                'account_status' => 1,
                'role_id' => 1,
                'password' => Hash::make('Vudat1328@'),
            ],
        ];
        User::insert($user);
    }
}

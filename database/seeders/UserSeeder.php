<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Hash;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'first_name' => 'admin',
                'last_name' => 'singh',
                'email' => 'admin@gmail.com',
                'phone'  => '9966338855',
                'address' => 'uk01',
                'city'    => 'india',
                'password' => Hash::make('password'),
                'role'     => 'admin',
            ],
            [
                'first_name' => 'user',
                'last_name' => 'demo',
                'email' => 'user@gmail.com',
                'phone'  => '7788996655',
                'address' => 'mohali',
                'city'    => 'india',
                'password' => Hash::make('password'),
                'role'     => 'user'
            ]
        ];
        foreach ($users as $userData) {
            User::create($userData);
        }
    }
}

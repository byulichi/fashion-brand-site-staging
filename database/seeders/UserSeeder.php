<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'azim sofi',
                'email' => 'azimmiskandar@gmail.com',
                'phone' => '0193100784',
                'password' => Hash::make('123'),
                'role' => 0,
            ],
            [
                'name' => 'test1',
                'email' => 'test@test.com',
                'phone' => '0123456789',
                'password' => Hash::make('123'),
                'role' => 0,
            ],
            [
                'name' => 'staff',
                'email' => 'staff@staff.com',
                'phone' => null,
                'password' => Hash::make('staff'),
                'role' => 1,
            ],
        ];

        foreach ($users as $data) {
            $user = User::updateOrCreate([
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'password' => $data['password'],
                'role' => $data['role'],
            ]);
        }
    }
}


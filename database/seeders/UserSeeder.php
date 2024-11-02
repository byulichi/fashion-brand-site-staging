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
                'name' => 'user1',
                'email' => 'azimmiskandar@gmail.com',
                'password' => Hash::make('123'),
            ],
            [
                'name' => 'admin',
                'email' => 'admin',
                'password' => Hash::make('admin'),
            ],
        ];

        foreach ($users as $data) {
            $user = User::updateOrCreate([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => $data['password'],
            ]);
        }
    }
}


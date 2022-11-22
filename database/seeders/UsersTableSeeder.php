<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'name' => 'John Smith',
                'email' => 'user1@example.com',
                'password' => bcrypt('123456'),
            ],
            [
                'name' => 'Angel Morton',
                'email' => 'user2@example.com',
                'password' => bcrypt('123456'),
            ],
        ];

        foreach ($users as $user) {
            User::updateOrCreate(
                [
                    'email' => $user['email']
                ],
                [
                    'name' => $user['name'],
                    'password' => $user['password']
                ]
            );
        }
    }
}

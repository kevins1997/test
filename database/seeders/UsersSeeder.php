<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'Admin',
                'email' => 'admin@email.com',
                'password' => bcrypt('secret'),
                'role_id' => '1',
                'remember_token' => null,
            ],
            [
                'name' => 'User',
                'email' => 'user@email.com',
                'password' => bcrypt('secret'),
                'role_id' => '2',
                'remember_token' => null,
            ]
        ];

        User::insert($users);
    }
}

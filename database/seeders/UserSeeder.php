<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Hash;

class UserSeeder extends Seeder
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
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Jane Smith',
                'email' => 'jane@example.com',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Alex Johnson',
                'email' => 'alex@example.com',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Emily Davis',
                'email' => 'emily@example.com',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Michael Brown',
                'email' => 'michael@example.com',
                'password' => Hash::make('password'),
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}

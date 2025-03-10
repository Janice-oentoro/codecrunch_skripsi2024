<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users= [[
            'name' => 'user',
            'email' => 'user@gmail.com',
            'password' => bcrypt('12345678'),
            'phone' => '12345678',
            'role' => 'user',
        ],
        [
            'name' => 'consultant',
            'email' => 'consultant@gmail.com',
            'password' => bcrypt('12345678'),
            'phone' => '12345678',
            'price' => 123000,
            'role' => 'consultant'
        ],
        [
            'name' => 'user1',
            'email' => 'user1@gmail.com',
            'password' => bcrypt('12345678'),
            'phone' => '12345678',
            'role' => 'user',
        ],
        [
            'name' => 'consultant1',
            'email' => 'consultant1@gmail.com',
            'password' => bcrypt('12345678'),
            'phone' => '12345678',
            'price' => 456000,
            'role' => 'consultant'
        ],
        [
            'name' => 'user2',
            'email' => 'user2@gmail.com',
            'password' => bcrypt('12345678'),
            'phone' => '12345678',
            'role' => 'user'
        ],
        [
            'name' => 'Chris Martinez',
            'email' => 'chris@example.com',
            'password' => bcrypt('12345678'),
            'phone' => '12345678',
            'role' => 'consultant'
        ],
        [
            'name' => 'Jessica Lee',
            'email' => 'jessica@example.com',
            'password' => bcrypt('12345678'),
            'phone' => '12345678',
            'role' => 'consultant'
        ],
        [
            'name' => 'Kevin Clark',
            'email' => 'kevin@example.com',
            'password' => bcrypt('12345678'),
            'phone' => '12345678',
            'role' => 'consultant'
        ],
        [
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('12345678'),
            'phone' => '12345678',
            'role' => 'admin'
        ],
        [
            'name' => 'Amanda Rodriguez',
            'email' => 'amanda@example.com',
            'password' => bcrypt('12345678'),
            'phone' => '12345678',
            'role' => 'consultant'
        ],
        [
            'name' => 'Daniel White',
            'email' => 'daniel@example.com',
            'password' => bcrypt('12345678'),
            'phone' => '12345678',
            'role' => 'consultant'
        ],
        [
            'name' => 'Stephanie Harris',
            'email' => 'stephanie@example.com',
            'password' => bcrypt('12345678'),
            'phone' => '12345678',
            'role' => 'consultant'
        ],
        [
            'name' => 'Robert Thompson',
            'email' => 'robert@example.com',
            'password' => bcrypt('12345678'),
            'phone' => '12345678',
            'role' => 'consultant'
        ],
        [
            'name' => 'Michelle King',
            'email' => 'michelle@example.com',
            'password' => bcrypt('12345678'),
            'phone' => '12345678',
            'role' => 'consultant'
        ],
        [
            'name' => 'Mark Garcia',
            'email' => 'mark@example.com',
            'password' => bcrypt('12345678'),
            'phone' => '12345678',
            'role' => 'consultant'
        ]
    ];
        foreach ($users as $key => $value) {
        User::create($value);
    }

    }
}

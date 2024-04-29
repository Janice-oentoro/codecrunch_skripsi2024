<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
            'role' => 'consultant'
        ],
        [
            'name' => 'user2',
            'email' => 'user2@gmail.com',
            'password' => bcrypt('12345678'),
            'phone' => '12345678',
            'role' => 'user',
        ],
        [
            'name' => 'consultant2',
            'email' => 'consultant2@gmail.com',
            'password' => bcrypt('12345678'),
            'phone' => '12345678',
            'role' => 'consultant'
        ],
        [
            'name' => 'user3',
            'email' => 'user3@gmail.com',
            'password' => bcrypt('12345678'),
            'role' => 'user'
        ],
        [
            'name' => 'consultant3',
            'email' => 'sarah@example.com',
            'password' => bcrypt('12345678'),
            'role' => 'consultant'
        ],
        [
            'name' => 'Chris Martinez',
            'email' => 'chris@example.com',
            'password' => bcrypt('passwordjkl'),
            'role' => 'user'
        ],
        [
            'name' => 'Jessica Lee',
            'email' => 'jessica@example.com',
            'password' => bcrypt('passwordmno'),
            'role' => 'user'
        ],
        [
            'name' => 'Kevin Clark',
            'email' => 'kevin@example.com',
            'password' => bcrypt('passwordpqr'),
            'role' => 'user'
        ],
        [
            'name' => 'Amanda Rodriguez',
            'email' => 'amanda@example.com',
            'password' => bcrypt('passwordstu'),
            'role' => 'user'
        ],
        [
            'name' => 'Daniel White',
            'email' => 'daniel@example.com',
            'password' => bcrypt('passwordvwx'),
            'role' => 'user'
        ],
        [
            'name' => 'Stephanie Harris',
            'email' => 'stephanie@example.com',
            'password' => bcrypt('passwordyz1'),
            'role' => 'user'
        ],
        [
            'name' => 'Robert Thompson',
            'email' => 'robert@example.com',
            'password' => bcrypt('password234'),
            'role' => 'user'
        ],
        [
            'name' => 'Michelle King',
            'email' => 'michelle@example.com',
            'password' => bcrypt('password567'),
            'role' => 'user'
        ],
        [
            'name' => 'Mark Garcia',
            'email' => 'mark@example.com',
            'password' => bcrypt('password890'),
            'role' => 'user'
        ]
    ];
        foreach ($users as $key => $value) {
        User::create($value);
    }

    }
}

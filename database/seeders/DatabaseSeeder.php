<?php

namespace Database\Seeders;

use App\Models\TopicConsultant;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call([
            TopicSeeder::class,
            ProgrammingSeeder::class,
            UserSeeder::class,
            ProgConsultantSeeder::class,
            TopicConsultantSeeder::class
        ]);
    }
}

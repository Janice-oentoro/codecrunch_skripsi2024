<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TopicConsultant;

class TopicConsultantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tcs = [[
            'topic_id' => 1,
            'consultant_id' => 2
        ],
        [
            'topic_id' => 2,
            'consultant_id' => 2
        ],
        [
            'topic_id' => 10,
            'consultant_id' => 2
        ],
        [
            'topic_id' => 1,
            'consultant_id' => 4
        ],
        [
            'topic_id' => 3,
            'consultant_id' => 4
        ],
        [
            'topic_id' => 6,
            'consultant_id' => 4
        ],
        ];

        foreach ($tcs as $key => $value) {
            TopicConsultant::create($value);
        }
    }
}

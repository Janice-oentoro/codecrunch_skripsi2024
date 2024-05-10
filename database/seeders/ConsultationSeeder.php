<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Consultation;

class ConsultationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $c = [[
            'user_id' => 1,
            'consultant_id' => 2,
            'consult_datetime' => '2024-5-12 14:00:00',
            'end_consult_datetime' => '2024-5-12 14:10:00',
            'title' => 'title1',
            'desc' => 'desc1',
            'type' => 'video conferece',
            'status' => 'coming soon',
            'link' => 'link1'
        ],
        ];

        foreach ($c as $key => $value) {
            Consultation::create($value);
        }
    }
}

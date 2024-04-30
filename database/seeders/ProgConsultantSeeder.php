<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProgConsultant;

class ProgConsultantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pcs = [[
            'prog_id' => 1,
            'consultant_id' => 2
        ],
        [
            'prog_id' => 2,
            'consultant_id' => 2
        ],
        [
            'prog_id' => 14,
            'consultant_id' => 2
        ],
        [
            'prog_id' => 1,
            'consultant_id' => 4
        ],
        [
            'prog_id' => 5,
            'consultant_id' => 4
        ],
        [
            'prog_id' => 21,
            'consultant_id' => 4
        ],
        ];

        foreach ($pcs as $key => $value) {
            ProgConsultant::create($value);
        }
    }
}

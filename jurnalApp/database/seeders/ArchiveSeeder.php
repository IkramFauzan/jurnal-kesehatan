<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Archive;

class ArchiveSeeder extends Seeder
{
    public function run() {
        Archive::create([
            'journal_name' => 'Jurnal Kesehatan',
            'volume' => '17',
            'issue' => '2',
            'year' => '2024',
            'description' => 'Volume terbaru Jurnal Kesehatan.',
        ]);

        Archive::create([
            'journal_name' => 'Jurnal Kesehatan',
            'volume' => '16',
            'issue' => '1',
            'year' => '2023',
            'description' => 'Edisi khusus kesehatan masyarakat.',
        ]);
    }
}

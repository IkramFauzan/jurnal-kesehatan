<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UploadModel;

class JurnalSeeder extends Seeder
{
    public function run()
    {
        UploadModel::create([
            'title' => 'The Potential of Secang Wood Decoction',
            'subtitle' => 'Potensi Air Rebusan Kayu Secang',
            'authors' => 'Kurnia Harli, Irfan, Nur Auliayah Febriani',
            'pages' => '116-122',
            'file_path' => 'uploads/jurnal1.pdf',
            'doi_link' => 'https://doi.org/10.24252/kesehatan.v17i2.39658',
            'views' => 117,
            'downloads' => 83,
        ]);
    }
}

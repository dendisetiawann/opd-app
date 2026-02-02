<?php

namespace Database\Seeders;

use App\Models\Opd;
use Illuminate\Database\Seeder;

class OpdSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $opds = [
            'Dinas Komunikasi dan Informatika',
            'Dinas Pendidikan',
            'Dinas Kesehatan',
            'Dinas Perhubungan',
            'Dinas Sosial',
            'Dinas Kependudukan dan Pencatatan Sipil',
            'Dinas Tenaga Kerja',
            'Dinas Perindustrian dan Perdagangan',
            'Badan Perencanaan Pembangunan Daerah',
            'Badan Kepegawaian Daerah',
        ];

        foreach ($opds as $opd) {
            Opd::create(['nama_opd' => $opd]);
        }
    }
}

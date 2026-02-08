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
            // Sekretariat
            'Sekretariat Daerah Kota Pekanbaru',
            'Sekretariat DPRD Kota Pekanbaru',
            
            // Inspektorat
            'Inspektorat Kota Pekanbaru',
            
            // Dinas-dinas
            'Dinas Pendidikan Kota Pekanbaru',
            'Dinas Kesehatan Kota Pekanbaru',
            'Dinas Pekerjaan Umum dan Penataan Ruang Kota Pekanbaru',
            'Dinas Perumahan Rakyat dan Kawasan Permukiman Kota Pekanbaru',
            'Dinas Sosial Kota Pekanbaru',
            'Dinas Tenaga Kerja Kota Pekanbaru',
            'Dinas Pemberdayaan Perempuan dan Perlindungan Anak Kota Pekanbaru',
            'Dinas Ketahanan Pangan Kota Pekanbaru',
            'Dinas Lingkungan Hidup dan Kebersihan Kota Pekanbaru',
            'Dinas Kependudukan dan Pencatatan Sipil Kota Pekanbaru',
            'Dinas Pemberdayaan Masyarakat dan Kelurahan Kota Pekanbaru',
            'Dinas Pengendalian Penduduk dan Keluarga Berencana Kota Pekanbaru',
            'Dinas Perhubungan Kota Pekanbaru',
            'Dinas Komunikasi dan Informatika Kota Pekanbaru',
            'Dinas Koperasi, Usaha Kecil dan Menengah Kota Pekanbaru',
            'Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu Kota Pekanbaru',
            'Dinas Kepemudaan dan Olahraga Kota Pekanbaru',
            'Dinas Kebudayaan dan Pariwisata Kota Pekanbaru',
            'Dinas Perpustakaan dan Kearsipan Kota Pekanbaru',
            'Dinas Perikanan Kota Pekanbaru',
            'Dinas Pertanian dan Peternakan Kota Pekanbaru',
            'Dinas Perdagangan dan Perindustrian Kota Pekanbaru',
            
            // Badan-badan
            'Badan Perencanaan Pembangunan Daerah Kota Pekanbaru',
            'Badan Pengelolaan Keuangan dan Aset Daerah Kota Pekanbaru',
            'Badan Pendapatan Daerah Kota Pekanbaru',
            'Badan Kepegawaian dan Pengembangan Sumber Daya Manusia Kota Pekanbaru',
            'Badan Penelitian dan Pengembangan Kota Pekanbaru',
            'Badan Penanggulangan Bencana Daerah Kota Pekanbaru',
            'Badan Kesatuan Bangsa dan Politik Kota Pekanbaru',
            
            // Satuan
            'Satuan Polisi Pamong Praja Kota Pekanbaru',
            
            // Kecamatan
            'Kecamatan Pekanbaru Kota',
            'Kecamatan Sukajadi',
            'Kecamatan Lima Puluh',
            'Kecamatan Sail',
            'Kecamatan Senapelan',
            'Kecamatan Bukit Raya',
            'Kecamatan Marpoyan Damai',
            'Kecamatan Tampan',
            'Kecamatan Payung Sekaki',
            'Kecamatan Tenayan Raya',
            'Kecamatan Rumbai',
            'Kecamatan Rumbai Barat',
        ];

        foreach ($opds as $opd) {
            Opd::create(['nama_opd' => $opd]);
        }
    }
}

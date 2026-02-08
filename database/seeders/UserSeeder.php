<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use App\Models\Opd;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userRole = Role::where('name', 'user')->first();
        $opds = Opd::all();
        
        // Mapping singkatan OPD untuk email
        $opdCodes = [
            'Sekretariat Daerah Kota' => 'setda',
            'Sekretariat DPRD' => 'sekwan',
            'Inspektorat Kota' => 'inspektorat',
            'Dinas Pendidikan' => 'disdik',
            'Dinas Kesehatan' => 'dinkes',
            'Dinas Pekerjaan Umum' => 'pupr',
            'Dinas Perumahan Rakyat' => 'perkim',
            'Dinas Sosial' => 'dinsos',
            'Dinas Tenaga Kerja' => 'disnaker',
            'Dinas Pemberdayaan Perempuan' => 'dp3a',
            'Dinas Ketahanan Pangan' => 'dkp',
            'Dinas Lingkungan Hidup' => 'dlhk',
            'Dinas Kependudukan' => 'disdukcapil',
            'Dinas Pemberdayaan Masyarakat' => 'dpmk',
            'Dinas Pengendalian Penduduk' => 'dp2kb',
            'Dinas Perhubungan' => 'dishub',
            'Dinas Komunikasi dan Informatika' => 'diskominfo',
            'Dinas Koperasi' => 'diskopukm',
            'Dinas Penanaman Modal' => 'dpmptsp',
            'Dinas Kepemudaan' => 'dispora',
            'Dinas Kebudayaan' => 'disbudpar',
            'Dinas Perpustakaan' => 'disperpusip',
            'Dinas Perikanan' => 'diskan',
            'Dinas Pertanian' => 'distanak',
            'Dinas Perdagangan' => 'disdagperin',
            'Badan Perencanaan Pembangunan' => 'bappeda',
            'Badan Pengelolaan Keuangan' => 'bpkad',
            'Badan Pendapatan Daerah' => 'bapenda',
            'Badan Kepegawaian' => 'bkpsdm',
            'Badan Penelitian' => 'balitbang',
            'Badan Penanggulangan Bencana' => 'bpbd',
            'Badan Kesatuan Bangsa' => 'kesbangpol',
            'Satuan Polisi Pamong Praja' => 'satpolpp',
            'Kecamatan Pekanbaru Kota' => 'kecpkukota',
            'Kecamatan Sukajadi' => 'kecsukajadi',
            'Kecamatan Lima Puluh' => 'keclimapuluh',
            'Kecamatan Sail' => 'kecsail',
            'Kecamatan Senapelan' => 'kecsenapelan',
            'Kecamatan Bukit Raya' => 'kecbukitraya',
            'Kecamatan Marpoyan Damai' => 'kecmarpoyan',
            'Kecamatan Tampan' => 'kectampan',
            'Kecamatan Payung Sekaki' => 'kecpayungsekaki',
            'Kecamatan Tenayan Raya' => 'kectenayan',
            'Kecamatan Rumbai Barat' => 'kecrumbaibarat',
            'Kecamatan Rumbai' => 'kecrumbai',
        ];

        foreach ($opds as $opd) {
            // Cari kode OPD
            $code = null;
            foreach ($opdCodes as $key => $value) {
                if (str_contains($opd->nama_opd, $key)) {
                    $code = $value;
                    break;
                }
            }
            
            // Jika tidak ada matching, buat code dari opd id
            if ($code === null) {
                $code = 'opd' . $opd->id;
            }

            // Buat 2 user per OPD
            for ($i = 1; $i <= 2; $i++) {
                User::create([
                    'name' => "User {$i} " . ucfirst($code),
                    'email' => "{$code}.user{$i}@pekanbaru.go.id",
                    'password' => Hash::make('password123'),
                    'role_id' => $userRole->id,
                    'opd_id' => $opd->id,
                    'email_verified_at' => now(),
                ]);
            }
        }
    }
}

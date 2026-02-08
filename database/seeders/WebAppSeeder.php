<?php

namespace Database\Seeders;

use App\Models\WebApp;
use App\Models\User;
use App\Models\Opd;
use Illuminate\Database\Seeder;

class WebAppSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Web/App templates per OPD type
        $webAppTemplates = $this->getWebAppTemplates();
        
        $opds = Opd::all();
        
        foreach ($opds as $opd) {
            // Get users for this OPD
            $users = User::where('opd_id', $opd->id)->get();
            if ($users->isEmpty()) continue;
            
            // Find matching template
            $template = $this->findTemplate($opd->nama_opd, $webAppTemplates);
            
            // Create web apps for this OPD
            $userIndex = 0;
            foreach ($template as $app) {
                $user = $users[$userIndex % $users->count()];
                $userIndex++;
                
                WebApp::create([
                    'user_id' => $user->id,
                    'opd_id' => $opd->id,
                    'nama_web_app' => $app['nama'],
                    'deskripsi_singkat' => $app['deskripsi'],
                    'alamat_tautan' => $app['alamat_tautan'],
                    'data_tim_programmer' => $app['tim'],
                    'email_narahubung' => $app['email'],
                    'bahasa_pemrograman' => $app['bahasa_pemrograman'],
                    'arsitektur_sistem' => $app['arsitektur'],
                    'framework' => $app['framework'],
                    'daftar_library_package' => $app['library'],
                    'has_repository' => $app['has_repo'],
                    'git_repository' => $app['git_type'],
                    'penyedia_repository' => $app['penyedia_repo'],
                    'metode_backup_source_code' => $app['backup_code'],
                    'metode_backup_asset' => $app['backup_asset'],
                    'nama_database' => $app['db_nama'],
                    'versi_database' => $app['db_versi'],
                    'dbms' => $app['dbms'],
                    'versi_dbms' => $app['dbms_versi'],
                    'lokasi_database' => $app['db_lokasi'],
                    'akses_database' => $app['db_akses'],
                    'metode_backup_database' => $app['backup_db'],
                    'integrasi_sistem_keluar' => $app['integrasi'],
                    'metode_monitoring_evaluasi' => $app['monev'],
                ]);
            }
        }
    }

    private function findTemplate(string $opdName, array $templates): array
    {
        foreach ($templates as $key => $template) {
            if (str_contains($opdName, $key)) {
                return $template;
            }
        }
        // Default template for kecamatan and others
        return $templates['default'];
    }

    private function getWebAppTemplates(): array
    {
        return [
            'Sekretariat Daerah' => [
                $this->createApp('Portal Setda Pekanbaru', 'Website resmi Sekretariat Daerah Kota Pekanbaru untuk layanan informasi publik', 'https://setda.pekanbaru.go.id', 'setda'),
                $this->createApp('SIMDA - Sistem Informasi Manajemen Daerah', 'Aplikasi pengelolaan data dan informasi pemerintahan daerah', 'https://simda.pekanbaru.go.id', 'setda'),
                $this->createApp('E-Protokol', 'Sistem manajemen keprotokolan dan acara resmi pemerintah', 'https://protokol.pekanbaru.go.id', 'setda'),
                $this->createApp('E-Sakip Setda', 'Aplikasi Sistem Akuntabilitas Kinerja Instansi Pemerintah', 'https://esakip.setda.pekanbaru.go.id', 'setda'),
                $this->createApp('E-Arsip Setda', 'Sistem pengelolaan arsip digital Sekretariat Daerah', 'https://arsip-setda.pekanbaru.go.id', 'setda'),
            ],
            'Sekretariat DPRD' => [
                $this->createApp('Portal DPRD Pekanbaru', 'Website resmi Dewan Perwakilan Rakyat Daerah Kota Pekanbaru', 'https://dprd.pekanbaru.go.id', 'sekwan'),
                $this->createApp('SIPD - Sistem Informasi Pemerintahan Daerah', 'Aplikasi pendukung perencanaan dan penganggaran daerah', 'https://sipd.pekanbaru.go.id', 'sekwan'),
                $this->createApp('E-Risalah DPRD', 'Sistem dokumentasi risalah rapat dan sidang DPRD', 'https://risalah.dprd.pekanbaru.go.id', 'sekwan'),
                $this->createApp('E-Agenda DPRD', 'Aplikasi penjadwalan kegiatan anggota DPRD', 'https://agenda.dprd.pekanbaru.go.id', 'sekwan'),
                $this->createApp('Sistem Informasi Legislasi', 'Portal peraturan daerah dan produk hukum', 'https://legislasi.dprd.pekanbaru.go.id', 'sekwan'),
            ],
            'Inspektorat' => [
                $this->createApp('Portal Inspektorat', 'Website resmi Inspektorat Kota Pekanbaru', 'https://inspektorat.pekanbaru.go.id', 'inspektorat'),
                $this->createApp('SIMWAS - Sistem Informasi Manajemen Pengawasan', 'Aplikasi manajemen pengawasan internal pemerintah', 'https://simwas.inspektorat.pekanbaru.go.id', 'inspektorat'),
                $this->createApp('E-Audit', 'Sistem audit elektronik dan monitoring tindak lanjut', 'https://audit.inspektorat.pekanbaru.go.id', 'inspektorat'),
                $this->createApp('Sistem Pengaduan Masyarakat', 'Portal pengaduan dan pelaporan masyarakat', 'https://pengaduan.inspektorat.pekanbaru.go.id', 'inspektorat'),
                $this->createApp('E-LHKPN', 'Aplikasi Laporan Harta Kekayaan Penyelenggara Negara', 'https://lhkpn.inspektorat.pekanbaru.go.id', 'inspektorat'),
            ],
            'Dinas Pendidikan' => [
                $this->createApp('Portal Disdik Pekanbaru', 'Website resmi Dinas Pendidikan Kota Pekanbaru', 'https://disdik.pekanbaru.go.id', 'disdik'),
                $this->createApp('PPDB Online', 'Sistem Penerimaan Peserta Didik Baru secara online', 'https://ppdb.pekanbaru.go.id', 'disdik'),
                $this->createApp('SIPDIK - Sistem Informasi Pendidikan', 'Aplikasi data pendidikan Kota Pekanbaru', 'https://sipdik.pekanbaru.go.id', 'disdik'),
                $this->createApp('Dapodik Pekanbaru', 'Aplikasi Data Pokok Pendidikan tingkat kota', 'https://app.disdik.pekanbaru.go.id', 'disdik'),
                $this->createApp('E-Rapor', 'Sistem pengelolaan rapor elektronik sekolah', 'https://app.disdik.pekanbaru.go.id', 'disdik'),
            ],
            'Dinas Kesehatan' => [
                $this->createApp('Portal Dinkes Pekanbaru', 'Website resmi Dinas Kesehatan Kota Pekanbaru', 'https://dinkes.pekanbaru.go.id', 'dinkes'),
                $this->createApp('SIK - Sistem Informasi Kesehatan', 'Aplikasi data kesehatan masyarakat Pekanbaru', 'https://sik.dinkes.pekanbaru.go.id', 'dinkes'),
                $this->createApp('E-Puskesmas', 'Sistem informasi manajemen Puskesmas', 'https://app.dinkes.pekanbaru.go.id', 'dinkes'),
                $this->createApp('SIMPUS', 'Sistem Informasi Manajemen Puskesmas terpadu', 'https://simpus.dinkes.pekanbaru.go.id', 'dinkes'),
                $this->createApp('Info Puskesmas', 'Portal informasi layanan Puskesmas Kota Pekanbaru', 'https://puskesmas.dinkes.pekanbaru.go.id', 'dinkes'),
            ],
            'Dinas Pekerjaan Umum dan Penataan Ruang' => [
                $this->createApp('Portal PUPR Pekanbaru', 'Website resmi Dinas PUPR Kota Pekanbaru', 'https://pupr.pekanbaru.go.id', 'pupr'),
                $this->createApp('Sistem Informasi Tata Ruang', 'Aplikasi informasi penataan ruang dan IMB', 'https://tataruang.pupr.pekanbaru.go.id', 'pupr'),
                $this->createApp('E-Monitoring Proyek', 'Sistem monitoring proyek infrastruktur', 'https://monitoring.pupr.pekanbaru.go.id', 'pupr'),
                $this->createApp('SIMBADA', 'Sistem Informasi Manajemen Bangunan Daerah', 'https://app.pupr.pekanbaru.go.id', 'pupr'),
                $this->createApp('E-Kontrak PUPR', 'Aplikasi manajemen kontrak proyek', 'https://app.pupr.pekanbaru.go.id', 'pupr'),
            ],
            'Dinas Perumahan Rakyat dan Kawasan Permukiman' => [
                $this->createApp('Portal Perkim Pekanbaru', 'Website resmi Dinas Perkim Kota Pekanbaru', 'https://perkim.pekanbaru.go.id', 'perkim'),
                $this->createApp('PSU Perkim', 'Sistem Prasarana Sarana Utilitas Umum', 'https://psu.perkim.pekanbaru.go.id', 'perkim'),
                $this->createApp('Sistem Informasi Rusun', 'Portal informasi rumah susun Pekanbaru', 'https://rusun.perkim.pekanbaru.go.id', 'perkim'),
                $this->createApp('E-Rumah', 'Aplikasi database perumahan masyarakat', 'https://app.perkim.pekanbaru.go.id', 'perkim'),
                $this->createApp('SIKPR', 'Sistem Informasi Kawasan Permukiman Rawan', 'https://app.perkim.pekanbaru.go.id', 'perkim'),
            ],
            'Dinas Sosial' => [
                $this->createApp('Portal Dinsos Pekanbaru', 'Website resmi Dinas Sosial Kota Pekanbaru', 'https://dinsos.pekanbaru.go.id', 'dinsos'),
                $this->createApp('DTKS Online', 'Sistem Data Terpadu Kesejahteraan Sosial', 'https://dtks.dinsos.pekanbaru.go.id', 'dinsos'),
                $this->createApp('Sistem Bantuan Sosial', 'Portal informasi dan pendaftaran bansos', 'https://bansos.dinsos.pekanbaru.go.id', 'dinsos'),
                $this->createApp('SIKS-NG', 'Sistem Informasi Kesejahteraan Sosial Next Generation', 'https://app.dinsos.pekanbaru.go.id', 'dinsos'),
                $this->createApp('E-Bansos', 'Aplikasi monitoring distribusi bantuan sosial', 'https://app.dinsos.pekanbaru.go.id', 'dinsos'),
            ],
            'Dinas Tenaga Kerja' => [
                $this->createApp('Portal Disnaker Pekanbaru', 'Website resmi Dinas Tenaga Kerja Kota Pekanbaru', 'https://disnaker.pekanbaru.go.id', 'disnaker'),
                $this->createApp('Bursa Kerja Online', 'Portal lowongan kerja dan pencari kerja', 'https://bkol.disnaker.pekanbaru.go.id', 'disnaker'),
                $this->createApp('Sistem Informasi Pelatihan', 'Portal pelatihan ketenagakerjaan', 'https://pelatihan.disnaker.pekanbaru.go.id', 'disnaker'),
                $this->createApp('SISNAKER', 'Sistem Informasi Ketenagakerjaan Nasional', 'https://app.disnaker.pekanbaru.go.id', 'disnaker'),
                $this->createApp('E-KIOS Ketenagakerjaan', 'Aplikasi layanan mandiri ketenagakerjaan', 'https://app.disnaker.pekanbaru.go.id', 'disnaker'),
            ],
            'Dinas Pemberdayaan Perempuan dan Perlindungan Anak' => [
                $this->createApp('Portal DP3A Pekanbaru', 'Website resmi DP3A Kota Pekanbaru', 'https://dp3a.pekanbaru.go.id', 'dp3a'),
                $this->createApp('Sistem Pelaporan KDRT', 'Portal pelaporan kekerasan dalam rumah tangga', 'https://lapor-kdrt.dp3a.pekanbaru.go.id', 'dp3a'),
                $this->createApp('Info Perlindungan Anak', 'Portal informasi perlindungan anak', 'https://anak.dp3a.pekanbaru.go.id', 'dp3a'),
                $this->createApp('SIMFONI PPA', 'Sistem Informasi Online Perlindungan Perempuan dan Anak', 'https://app.dp3a.pekanbaru.go.id', 'dp3a'),
                $this->createApp('E-Lapor Anak', 'Aplikasi pelaporan kasus anak', 'https://app.dp3a.pekanbaru.go.id', 'dp3a'),
            ],
            'Dinas Ketahanan Pangan' => [
                $this->createApp('Portal DKP Pekanbaru', 'Website resmi Dinas Ketahanan Pangan Kota Pekanbaru', 'https://dkp.pekanbaru.go.id', 'dkp'),
                $this->createApp('Sistem Informasi Harga Pangan', 'Portal monitoring harga bahan pangan', 'https://harga.dkp.pekanbaru.go.id', 'dkp'),
                $this->createApp('Monitoring Stok Pangan', 'Sistem pemantauan stok pangan daerah', 'https://stok.dkp.pekanbaru.go.id', 'dkp'),
                $this->createApp('SIMPA', 'Sistem Informasi Manajemen Pangan', 'https://app.dkp.pekanbaru.go.id', 'dkp'),
                $this->createApp('E-Distribusi Pangan', 'Aplikasi distribusi pangan daerah', 'https://app.dkp.pekanbaru.go.id', 'dkp'),
            ],
            'Dinas Lingkungan Hidup dan Kebersihan' => [
                $this->createApp('Portal DLHK Pekanbaru', 'Website resmi DLHK Kota Pekanbaru', 'https://dlhk.pekanbaru.go.id', 'dlhk'),
                $this->createApp('Sistem Monitoring Kualitas Udara', 'Portal pemantauan kualitas udara realtime', 'https://udara.dlhk.pekanbaru.go.id', 'dlhk'),
                $this->createApp('E-Waste Management', 'Sistem pengelolaan sampah kota', 'https://sampah.dlhk.pekanbaru.go.id', 'dlhk'),
                $this->createApp('SIPSN', 'Sistem Informasi Pengelolaan Sampah Nasional', 'https://app.dlhk.pekanbaru.go.id', 'dlhk'),
                $this->createApp('E-Retribusi Sampah', 'Aplikasi pembayaran retribusi sampah', 'https://app.dlhk.pekanbaru.go.id', 'dlhk'),
            ],
            'Dinas Kependudukan dan Pencatatan Sipil' => [
                $this->createApp('Portal Disdukcapil Pekanbaru', 'Website resmi Disdukcapil Kota Pekanbaru', 'https://disdukcapil.pekanbaru.go.id', 'disdukcapil'),
                $this->createApp('Layanan Online Adminduk', 'Portal layanan administrasi kependudukan', 'https://layanan.disdukcapil.pekanbaru.go.id', 'disdukcapil'),
                $this->createApp('Cek NIK Online', 'Sistem pengecekan data kependudukan', 'https://ceknik.disdukcapil.pekanbaru.go.id', 'disdukcapil'),
                $this->createApp('Sipenduduk', 'Aplikasi layanan kependudukan mobile', 'https://app.disdukcapil.pekanbaru.go.id', 'disdukcapil'),
                $this->createApp('E-KTP Online', 'Sistem antrian dan tracking KTP elektronik', 'https://app.disdukcapil.pekanbaru.go.id', 'disdukcapil'),
            ],
            'Dinas Pemberdayaan Masyarakat dan Kelurahan' => [
                $this->createApp('Portal DPMK Pekanbaru', 'Website resmi DPMK Kota Pekanbaru', 'https://dpmk.pekanbaru.go.id', 'dpmk'),
                $this->createApp('Profil Kelurahan', 'Portal data profil kelurahan se-Pekanbaru', 'https://kelurahan.dpmk.pekanbaru.go.id', 'dpmk'),
                $this->createApp('Sistem Informasi Pemberdayaan', 'Portal program pemberdayaan masyarakat', 'https://pemberdayaan.dpmk.pekanbaru.go.id', 'dpmk'),
                $this->createApp('SIPADES', 'Sistem Informasi Pembangunan Desa/Kelurahan', 'https://app.dpmk.pekanbaru.go.id', 'dpmk'),
                $this->createApp('E-Musrenbang', 'Aplikasi Musyawarah Perencanaan Pembangunan', 'https://app.dpmk.pekanbaru.go.id', 'dpmk'),
            ],
            'Dinas Pengendalian Penduduk dan Keluarga Berencana' => [
                $this->createApp('Portal DP2KB Pekanbaru', 'Website resmi DP2KB Kota Pekanbaru', 'https://dp2kb.pekanbaru.go.id', 'dp2kb'),
                $this->createApp('SIGA - Sistem Informasi Keluarga', 'Portal data keluarga Indonesia', 'https://siga.dp2kb.pekanbaru.go.id', 'dp2kb'),
                $this->createApp('Konseling KB Online', 'Portal konsultasi keluarga berencana', 'https://konseling.dp2kb.pekanbaru.go.id', 'dp2kb'),
                $this->createApp('SIGA Mobile', 'Aplikasi Sistem Informasi Keluarga mobile', 'https://app.dp2kb.pekanbaru.go.id', 'dp2kb'),
                $this->createApp('E-Visum KB', 'Aplikasi pencatatan peserta KB', 'https://app.dp2kb.pekanbaru.go.id', 'dp2kb'),
            ],
            'Dinas Perhubungan' => [
                $this->createApp('Portal Dishub Pekanbaru', 'Website resmi Dinas Perhubungan Kota Pekanbaru', 'https://dishub.pekanbaru.go.id', 'dishub'),
                $this->createApp('Sistem Informasi Transportasi', 'Portal informasi transportasi publik', 'https://transport.dishub.pekanbaru.go.id', 'dishub'),
                $this->createApp('E-Parkir', 'Sistem manajemen parkir kota', 'https://parkir.dishub.pekanbaru.go.id', 'dishub'),
                $this->createApp('ATCS', 'Area Traffic Control System - Pengatur lalu lintas', 'https://app.dishub.pekanbaru.go.id', 'dishub'),
                $this->createApp('E-Tilang', 'Aplikasi tilang elektronik', 'https://app.dishub.pekanbaru.go.id', 'dishub'),
            ],
            'Dinas Komunikasi dan Informatika' => [
                $this->createApp('Portal Diskominfo Pekanbaru', 'Website resmi Diskominfo Kota Pekanbaru', 'https://diskominfo.pekanbaru.go.id', 'diskominfo'),
                $this->createApp('PPID Kota Pekanbaru', 'Portal Pejabat Pengelola Informasi dan Dokumentasi', 'https://ppid.pekanbaru.go.id', 'diskominfo'),
                $this->createApp('Command Center', 'Pusat kendali smart city Pekanbaru', 'https://commandcenter.pekanbaru.go.id', 'diskominfo'),
                $this->createApp('Pekanbaru AMAN', 'SuperApp layanan publik Kota Pekanbaru', 'https://app.diskominfo.pekanbaru.go.id', 'diskominfo'),
                $this->createApp('E-Office Pekanbaru', 'Sistem administrasi perkantoran elektronik', 'https://app.diskominfo.pekanbaru.go.id', 'diskominfo'),
            ],
            'Dinas Koperasi, Usaha Kecil dan Menengah' => [
                $this->createApp('Portal Diskop UKM Pekanbaru', 'Website resmi Dinas Koperasi dan UKM', 'https://diskopukm.pekanbaru.go.id', 'diskopukm'),
                $this->createApp('Direktori UMKM', 'Portal database UMKM Kota Pekanbaru', 'https://umkm.diskopukm.pekanbaru.go.id', 'diskopukm'),
                $this->createApp('E-Koperasi', 'Sistem informasi koperasi daerah', 'https://koperasi.diskopukm.pekanbaru.go.id', 'diskopukm'),
                $this->createApp('SIUKM', 'Sistem Informasi Usaha Kecil Menengah', 'https://app.diskopukm.pekanbaru.go.id', 'diskopukm'),
                $this->createApp('E-Lapak UMKM', 'Marketplace produk UMKM Pekanbaru', 'https://app.diskopukm.pekanbaru.go.id', 'diskopukm'),
            ],
            'Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu' => [
                $this->createApp('Portal DPMPTSP Pekanbaru', 'Website resmi DPMPTSP Kota Pekanbaru', 'https://dpmptsp.pekanbaru.go.id', 'dpmptsp'),
                $this->createApp('OSS Pekanbaru', 'Online Single Submission - Perizinan Berusaha', 'https://oss.dpmptsp.pekanbaru.go.id', 'dpmptsp'),
                $this->createApp('Tracking Perizinan', 'Sistem pelacakan status perizinan', 'https://tracking.dpmptsp.pekanbaru.go.id', 'dpmptsp'),
                $this->createApp('OSS Mobile', 'Aplikasi Online Single Submission mobile', 'https://app.dpmptsp.pekanbaru.go.id', 'dpmptsp'),
                $this->createApp('E-Perizinan', 'Sistem perizinan elektronik terpadu', 'https://app.dpmptsp.pekanbaru.go.id', 'dpmptsp'),
            ],
            'Dinas Kepemudaan dan Olahraga' => [
                $this->createApp('Portal Dispora Pekanbaru', 'Website resmi Dinas Kepemudaan dan Olahraga', 'https://dispora.pekanbaru.go.id', 'dispora'),
                $this->createApp('Booking Venue Olahraga', 'Sistem reservasi fasilitas olahraga', 'https://venue.dispora.pekanbaru.go.id', 'dispora'),
                $this->createApp('Portal Pemuda', 'Portal informasi kepemudaan Pekanbaru', 'https://pemuda.dispora.pekanbaru.go.id', 'dispora'),
                $this->createApp('E-Booking Venue', 'Aplikasi booking venue olahraga mobile', 'https://app.dispora.pekanbaru.go.id', 'dispora'),
                $this->createApp('SIPORDA', 'Sistem Informasi Pemuda dan Olahraga Daerah', 'https://app.dispora.pekanbaru.go.id', 'dispora'),
            ],
            'Dinas Kebudayaan dan Pariwisata' => [
                $this->createApp('Portal Disbudpar Pekanbaru', 'Website resmi Dinas Kebudayaan dan Pariwisata', 'https://disbudpar.pekanbaru.go.id', 'disbudpar'),
                $this->createApp('Visit Pekanbaru', 'Portal pariwisata Kota Pekanbaru', 'https://visit.pekanbaru.go.id', 'disbudpar'),
                $this->createApp('Event Budaya', 'Kalender event budaya Pekanbaru', 'https://event.disbudpar.pekanbaru.go.id', 'disbudpar'),
                $this->createApp('Pekanbaru Tourism', 'Aplikasi wisata Kota Pekanbaru', 'https://app.disbudpar.pekanbaru.go.id', 'disbudpar'),
                $this->createApp('E-Tiket Wisata', 'Sistem tiket destinasi wisata', 'https://app.disbudpar.pekanbaru.go.id', 'disbudpar'),
            ],
            'Dinas Perpustakaan dan Kearsipan' => [
                $this->createApp('Portal Disperpusip Pekanbaru', 'Website resmi Dinas Perpustakaan dan Kearsipan', 'https://disperpusip.pekanbaru.go.id', 'disperpusip'),
                $this->createApp('Perpustakaan Digital', 'Portal e-book dan koleksi digital', 'https://digilib.disperpusip.pekanbaru.go.id', 'disperpusip'),
                $this->createApp('E-Arsip Daerah', 'Sistem kearsipan daerah digital', 'https://arsip.disperpusip.pekanbaru.go.id', 'disperpusip'),
                $this->createApp('INLISLite', 'Integrated Library System perpustakaan', 'https://app.disperpusip.pekanbaru.go.id', 'disperpusip'),
                $this->createApp('E-Pustaka Pekanbaru', 'Aplikasi perpustakaan digital mobile', 'https://app.disperpusip.pekanbaru.go.id', 'disperpusip'),
            ],
            'Dinas Perikanan' => [
                $this->createApp('Portal Dinas Perikanan Pekanbaru', 'Website resmi Dinas Perikanan Kota Pekanbaru', 'https://diskan.pekanbaru.go.id', 'diskan'),
                $this->createApp('Sistem Informasi Nelayan', 'Database nelayan Kota Pekanbaru', 'https://nelayan.diskan.pekanbaru.go.id', 'diskan'),
                $this->createApp('Pasar Ikan Online', 'Marketplace hasil perikanan', 'https://pasarikan.diskan.pekanbaru.go.id', 'diskan'),
                $this->createApp('SIPERINA', 'Sistem Informasi Perikanan Daerah', 'https://app.diskan.pekanbaru.go.id', 'diskan'),
                $this->createApp('E-Nelayan', 'Aplikasi layanan nelayan mobile', 'https://app.diskan.pekanbaru.go.id', 'diskan'),
            ],
            'Dinas Pertanian dan Peternakan' => [
                $this->createApp('Portal Distanak Pekanbaru', 'Website resmi Dinas Pertanian dan Peternakan', 'https://distanak.pekanbaru.go.id', 'distanak'),
                $this->createApp('Sistem Informasi Pertanian', 'Portal data pertanian Pekanbaru', 'https://sia.distanak.pekanbaru.go.id', 'distanak'),
                $this->createApp('Info Harga Komoditas', 'Portal harga komoditas pertanian', 'https://harga.distanak.pekanbaru.go.id', 'distanak'),
                $this->createApp('SIMLUHTAN', 'Sistem Informasi Manajemen Penyuluhan Pertanian', 'https://app.distanak.pekanbaru.go.id', 'distanak'),
                $this->createApp('E-Ternak', 'Aplikasi data peternakan daerah', 'https://app.distanak.pekanbaru.go.id', 'distanak'),
            ],
            'Dinas Perdagangan dan Perindustrian' => [
                $this->createApp('Portal Disdagperin Pekanbaru', 'Website resmi Dinas Perdagangan dan Perindustrian', 'https://disdagperin.pekanbaru.go.id', 'disdagperin'),
                $this->createApp('Sistem Informasi Industri', 'Database industri Kota Pekanbaru', 'https://industri.disdagperin.pekanbaru.go.id', 'disdagperin'),
                $this->createApp('E-Pasar', 'Sistem informasi pasar tradisional', 'https://pasar.disdagperin.pekanbaru.go.id', 'disdagperin'),
                $this->createApp('SIINAS', 'Sistem Informasi Industri Nasional', 'https://app.disdagperin.pekanbaru.go.id', 'disdagperin'),
                $this->createApp('E-Retribusi Pasar', 'Aplikasi pembayaran retribusi pasar', 'https://app.disdagperin.pekanbaru.go.id', 'disdagperin'),
            ],
            'Badan Perencanaan Pembangunan Daerah' => [
                $this->createApp('Portal Bappeda Pekanbaru', 'Website resmi Bappeda Kota Pekanbaru', 'https://bappeda.pekanbaru.go.id', 'bappeda'),
                $this->createApp('E-Planning', 'Sistem perencanaan pembangunan daerah', 'https://eplanning.bappeda.pekanbaru.go.id', 'bappeda'),
                $this->createApp('Data Pembangunan', 'Portal data statistik pembangunan', 'https://data.bappeda.pekanbaru.go.id', 'bappeda'),
                $this->createApp('SIPD Perencanaan', 'Sistem Informasi Pemerintahan Daerah - Perencanaan', 'https://app.bappeda.pekanbaru.go.id', 'bappeda'),
                $this->createApp('E-Monev', 'Aplikasi monitoring dan evaluasi pembangunan', 'https://app.bappeda.pekanbaru.go.id', 'bappeda'),
            ],
            'Badan Pengelolaan Keuangan dan Aset Daerah' => [
                $this->createApp('Portal BPKAD Pekanbaru', 'Website resmi BPKAD Kota Pekanbaru', 'https://bpkad.pekanbaru.go.id', 'bpkad'),
                $this->createApp('SIMDA Keuangan', 'Sistem Informasi Manajemen Daerah - Keuangan', 'https://simda.bpkad.pekanbaru.go.id', 'bpkad'),
                $this->createApp('E-Aset', 'Sistem informasi manajemen aset daerah', 'https://aset.bpkad.pekanbaru.go.id', 'bpkad'),
                $this->createApp('SIMADANI', 'Sistem Informasi Manajemen Aset Daerah Terkini', 'https://app.bpkad.pekanbaru.go.id', 'bpkad'),
                $this->createApp('SIPKD', 'Sistem Informasi Pengelolaan Keuangan Daerah', 'https://app.bpkad.pekanbaru.go.id', 'bpkad'),
            ],
            'Badan Pendapatan Daerah' => [
                $this->createApp('Portal Bapenda Pekanbaru', 'Website resmi Bapenda Kota Pekanbaru', 'https://bapenda.pekanbaru.go.id', 'bapenda'),
                $this->createApp('Cek Pajak Online', 'Portal pengecekan tagihan pajak daerah', 'https://cekpajak.bapenda.pekanbaru.go.id', 'bapenda'),
                $this->createApp('E-SPPT PBB', 'Sistem SPPT PBB elektronik', 'https://pbb.bapenda.pekanbaru.go.id', 'bapenda'),
                $this->createApp('E-Pajak Pekanbaru', 'Aplikasi pembayaran pajak daerah', 'https://app.bapenda.pekanbaru.go.id', 'bapenda'),
                $this->createApp('SISMIOP', 'Sistem Informasi Manajemen Objek Pajak', 'https://app.bapenda.pekanbaru.go.id', 'bapenda'),
            ],
            'Badan Kepegawaian dan Pengembangan Sumber Daya Manusia' => [
                $this->createApp('Portal BKPSDM Pekanbaru', 'Website resmi BKPSDM Kota Pekanbaru', 'https://bkpsdm.pekanbaru.go.id', 'bkpsdm'),
                $this->createApp('SIMPEG', 'Sistem Informasi Manajemen Kepegawaian', 'https://simpeg.bkpsdm.pekanbaru.go.id', 'bkpsdm'),
                $this->createApp('E-Kinerja', 'Sistem penilaian kinerja ASN', 'https://kinerja.bkpsdm.pekanbaru.go.id', 'bkpsdm'),
                $this->createApp('SIMPEG Mobile', 'Aplikasi kepegawaian mobile', 'https://app.bkpsdm.pekanbaru.go.id', 'bkpsdm'),
                $this->createApp('E-Kinerja ASN', 'Aplikasi kinerja ASN mobile', 'https://app.bkpsdm.pekanbaru.go.id', 'bkpsdm'),
            ],
            'Badan Penelitian dan Pengembangan' => [
                $this->createApp('Portal Balitbang Pekanbaru', 'Website resmi Badan Litbang Kota Pekanbaru', 'https://balitbang.pekanbaru.go.id', 'balitbang'),
                $this->createApp('Repositori Penelitian', 'Database hasil penelitian daerah', 'https://repo.balitbang.pekanbaru.go.id', 'balitbang'),
                $this->createApp('Inovasi Daerah', 'Portal inovasi daerah Kota Pekanbaru', 'https://inovasi.balitbang.pekanbaru.go.id', 'balitbang'),
                $this->createApp('SIPRADA', 'Sistem Informasi Penelitian Daerah', 'https://app.balitbang.pekanbaru.go.id', 'balitbang'),
                $this->createApp('E-Litbang', 'Aplikasi manajemen penelitian', 'https://app.balitbang.pekanbaru.go.id', 'balitbang'),
            ],
            'Badan Penanggulangan Bencana Daerah' => [
                $this->createApp('Portal BPBD Pekanbaru', 'Website resmi BPBD Kota Pekanbaru', 'https://bpbd.pekanbaru.go.id', 'bpbd'),
                $this->createApp('Sistem Peringatan Dini', 'Early Warning System kebencanaan', 'https://ews.bpbd.pekanbaru.go.id', 'bpbd'),
                $this->createApp('Peta Rawan Bencana', 'Peta digital kerawanan bencana', 'https://peta.bpbd.pekanbaru.go.id', 'bpbd'),
                $this->createApp('INACRISIS', 'Sistem informasi penanggulangan bencana', 'https://app.bpbd.pekanbaru.go.id', 'bpbd'),
                $this->createApp('E-Bencana Pekanbaru', 'Aplikasi pelaporan bencana mobile', 'https://app.bpbd.pekanbaru.go.id', 'bpbd'),
            ],
            'Badan Kesatuan Bangsa dan Politik' => [
                $this->createApp('Portal Kesbangpol Pekanbaru', 'Website resmi Badan Kesbangpol Kota Pekanbaru', 'https://kesbangpol.pekanbaru.go.id', 'kesbangpol'),
                $this->createApp('Sistem Pendaftaran Ormas', 'Portal pendaftaran organisasi masyarakat', 'https://ormas.kesbangpol.pekanbaru.go.id', 'kesbangpol'),
                $this->createApp('Info Pemilu', 'Portal informasi pemilihan umum', 'https://pemilu.kesbangpol.pekanbaru.go.id', 'kesbangpol'),
                $this->createApp('SIORMAS', 'Sistem Informasi Organisasi Masyarakat', 'https://app.kesbangpol.pekanbaru.go.id', 'kesbangpol'),
                $this->createApp('E-SKT', 'Aplikasi Surat Keterangan Terdaftar online', 'https://app.kesbangpol.pekanbaru.go.id', 'kesbangpol'),
            ],
            'Satuan Polisi Pamong Praja' => [
                $this->createApp('Portal Satpol PP Pekanbaru', 'Website resmi Satpol PP Kota Pekanbaru', 'https://satpolpp.pekanbaru.go.id', 'satpolpp'),
                $this->createApp('Sistem Pelaporan Pelanggaran', 'Portal pelaporan pelanggaran Perda', 'https://lapor.satpolpp.pekanbaru.go.id', 'satpolpp'),
                $this->createApp('Info Perda', 'Portal sosialisasi peraturan daerah', 'https://perda.satpolpp.pekanbaru.go.id', 'satpolpp'),
                $this->createApp('E-Penegakan Perda', 'Sistem penegakan peraturan daerah', 'https://app.satpolpp.pekanbaru.go.id', 'satpolpp'),
                $this->createApp('Satpol PP Mobile', 'Aplikasi Satpol PP mobile', 'https://app.satpolpp.pekanbaru.go.id', 'satpolpp'),
            ],
            'default' => [
                $this->createApp('Portal Kecamatan', 'Website resmi informasi kecamatan', 'https://kecamatan.pekanbaru.go.id', 'kecamatan', true),
                $this->createApp('Profil Kelurahan', 'Portal profil kelurahan di kecamatan', 'https://kecamatan.pekanbaru.go.id', 'kecamatan', true),
                $this->createApp('Layanan Kecamatan', 'Portal layanan masyarakat tingkat kecamatan', 'https://kecamatan.pekanbaru.go.id', 'kecamatan', true),
                $this->createApp('E-Kelurahan', 'Aplikasi administrasi kelurahan', 'https://kecamatan.pekanbaru.go.id', 'kecamatan'),
                $this->createApp('SICAMAS', 'Sistem Informasi Camat Massa', 'https://kecamatan.pekanbaru.go.id', 'kecamatan'),
            ],
        ];
    }

    private function createApp(string $nama, string $deskripsi, string $alamatTautan, string $code, bool $isKecamatan = false): array
    {
        $backends = ['PHP', 'Python', 'Node.js', 'Java', 'Go'];
        $frontends = ['JavaScript', 'TypeScript', 'JavaScript', 'TypeScript'];
        $frameworks = ['Laravel 11.x', 'Django 5.0', 'Express.js 4.x', 'Spring Boot 3.x', 'CodeIgniter 4', 'Next.js 14.x', 'Vue.js 3', 'React 18'];
        $dbms = ['MySQL', 'PostgreSQL', 'MariaDB', 'SQL Server'];
        $libraries = [
            'Bootstrap 5, jQuery, DataTables, Chart.js, SweetAlert2',
            'Tailwind CSS, Alpine.js, Livewire, FilamentPHP',
            'React, Redux, Axios, Material-UI, React Query',
            'Vue.js, Vuex, Vuetify, Axios, Pinia',
            'Next.js, Prisma, NextAuth, Tailwind CSS',
        ];
        $penyediaRepo = ['GitHub', 'GitLab', 'Bitbucket', 'Azure DevOps'];
        $programmers = [
            "1. Ahmad Rizki - Backend Developer\n2. Budi Santoso - Frontend Developer\n3. Citra Dewi - UI/UX Designer",
            "1. Dian Permata - Full Stack Developer\n2. Eko Prasetyo - DevOps Engineer",
            "1. Fajar Nugroho - System Analyst\n2. Gita Maharani - Software Engineer\n3. Hendra Wijaya - Database Administrator",
            "1. Indah Sari - Project Manager\n2. Joko Widodo - Backend Developer\n3. Kartika Sari - QA Engineer",
            "1. Lukman Hakim - Lead Developer\n2. Maya Anggraini - Frontend Developer",
        ];

        $backend = $backends[array_rand($backends)];
        $frontend = $frontends[array_rand($frontends)];
        $framework = $frameworks[array_rand($frameworks)];
        $selectedDbms = $dbms[array_rand($dbms)];
        
        // Generate bahasa_pemrograman (combined backend + frontend)
        $backendVer = $backend === 'PHP' ? '8.2' : ($backend === 'Python' ? '3.11' : ($backend === 'Node.js' ? '20.x' : ($backend === 'Java' ? '17' : '1.21')));
        $frontendVer = $frontend === 'TypeScript' ? '5.0' : 'ES2022';
        $bahasaPemrograman = "{$backend} versi {$backendVer} dan {$frontend} versi {$frontendVer}";

        return [
            'nama' => $nama,
            'deskripsi' => $deskripsi,
            'alamat_tautan' => $alamatTautan,
            'tim' => $programmers[array_rand($programmers)],
            'email' => "{$code}@pekanbaru.go.id",
            'bahasa_pemrograman' => $bahasaPemrograman,
            'arsitektur' => rand(0, 1) ? 'monolith' : 'be-fe',
            'framework' => $framework,
            'library' => $libraries[array_rand($libraries)],
            'has_repo' => rand(0, 1) ? 'ya' : 'tidak',
            'git_type' => rand(0, 1) ? 'private' : 'public',
            'penyedia_repo' => $penyediaRepo[array_rand($penyediaRepo)],
            'backup_code' => 'Backup otomatis ke cloud storage setiap hari jam 00:00 WIB menggunakan cron job dan rsync',
            'backup_asset' => 'Sinkronisasi asset ke AWS S3/Google Cloud Storage dengan versioning enabled',
            'db_nama' => "db_{$code}_" . strtolower(str_replace([' ', '-'], '_', substr($nama, 0, 10))),
            'db_versi' => $selectedDbms === 'MySQL' ? '8.0' : ($selectedDbms === 'PostgreSQL' ? '16' : ($selectedDbms === 'MariaDB' ? '10.11' : '2022')),
            'dbms' => $selectedDbms,
            'dbms_versi' => $selectedDbms === 'MySQL' ? '8.0.35' : ($selectedDbms === 'PostgreSQL' ? '16.1' : ($selectedDbms === 'MariaDB' ? '10.11.6' : '16.0')),
            'db_lokasi' => rand(0, 1) ? 'server' : 'local',
            'db_akses' => 'private',
            'backup_db' => 'Backup database harian menggunakan mysqldump/pg_dump ke cloud storage dengan retensi 30 hari',
            'integrasi' => "Integrasi dengan Portal Pekanbaru AMAN, SSO Pemerintah Kota, dan API Gateway Diskominfo",
            'monev' => 'Monitoring menggunakan Grafana dan Prometheus, evaluasi kinerja bulanan melalui dashboard analytics',
        ];
    }
}


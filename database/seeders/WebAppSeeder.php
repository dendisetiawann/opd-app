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
                    'jenis_aplikasi' => $app['jenis_aplikasi'],
                    'data_tim_programmer' => $app['tim'],
                    'email_narahubung' => $app['email'],
                    'whatsapp_narahubung' => $app['whatsapp'],
                    'bahasa_pemrograman' => $app['bahasa_pemrograman'],
                    'arsitektur_sistem' => $app['arsitektur'],
                    'framework' => $app['framework'],
                    'daftar_library_package' => $app['library'],
                    'has_repository' => $app['has_repo'],
                    'git_repository' => $app['has_repo'] === 'ya' ? $app['git_type'] : null,
                    'penyedia_repository' => $app['has_repo'] === 'ya' ? $app['penyedia_repo'] : null,
                    'metode_backup_source_code' => $app['backup_code'],
                    'metode_backup_asset' => $app['backup_asset'],
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

    private static int $counter = 0;

    private function createApp(string $nama, string $deskripsi, string $alamatTautan, string $code, bool $isKecamatan = false): array
    {
        $i = self::$counter++;

        // Sequential rotation pools — each app gets different data
        $jenisAplikasi = ['Web Application', 'Mobile Application', 'Desktop Application'];

        $bahasaCombos = [
            // PHP variants
            'PHP 8.4', 'PHP 8.3', 'PHP 8.2', 'PHP 8.1', 'PHP 8.0',
            // Python variants
            'Python 3.13', 'Python 3.12', 'Python 3.11', 'Python 3.10', 'Python 3.9',
            // JavaScript/TypeScript variants
            'JavaScript ES2024', 'JavaScript ES2023', 'JavaScript ES2022', 'JavaScript ES2021',
            'TypeScript 5.7', 'TypeScript 5.6', 'TypeScript 5.5', 'TypeScript 5.4', 'TypeScript 5.3',
            // Java variants
            'Java 23', 'Java 21', 'Java 17', 'Java 11',
            // Go variants
            'Go 1.23', 'Go 1.22', 'Go 1.21', 'Go 1.20',
            // Kotlin variants
            'Kotlin 2.1', 'Kotlin 2.0', 'Kotlin 1.9',
            // Swift variants
            'Swift 6.0', 'Swift 5.10', 'Swift 5.9',
            // Rust variants
            'Rust 1.83', 'Rust 1.82', 'Rust 1.80',
            // C# variants
            'C# 13', 'C# 12', 'C# 11', 'C# 10',
            // Ruby variants
            'Ruby 3.4', 'Ruby 3.3', 'Ruby 3.2',
            // Dart variants
            'Dart 3.6', 'Dart 3.5', 'Dart 3.4',
            // Elixir variants
            'Elixir 1.17', 'Elixir 1.16',
            // Scala variants
            'Scala 3.5', 'Scala 3.4',
            // Lua variants
            'Lua 5.4',
            // R variants
            'R 4.4', 'R 4.3',
            // Perl variants
            'Perl 5.40', 'Perl 5.38',
            // Haskell variants
            'Haskell 9.10', 'Haskell 9.8',
            // Clojure variants
            'Clojure 1.12',
            // Groovy variants
            'Groovy 4.0',
            // Objective-C
            'Objective-C 2.0',
            // PHP + JS combos (mixed)
            'PHP 8.4, JavaScript ES2024',
            'PHP 8.3, TypeScript 5.7',
            'PHP 8.2, JavaScript ES2023',
            'PHP 8.1, TypeScript 5.6',
            'PHP 8.0, JavaScript ES2022',
            // Python + JS combos
            'Python 3.13, JavaScript ES2024',
            'Python 3.12, TypeScript 5.5',
            'Python 3.11, JavaScript ES2023',
            'Python 3.10, TypeScript 5.4',
            // Java + TS combos
            'Java 23, TypeScript 5.7',
            'Java 21, TypeScript 5.6',
            'Java 17, JavaScript ES2024',
            // Go + JS combos
            'Go 1.23, JavaScript ES2024',
            'Go 1.22, TypeScript 5.7',
            // Kotlin + TS combos
            'Kotlin 2.1, TypeScript 5.7',
            'Kotlin 2.0, JavaScript ES2024',
            // Swift + JS combos
            'Swift 6.0, JavaScript ES2024',
            'Swift 5.10, TypeScript 5.6',
            // Rust + TS combos
            'Rust 1.83, TypeScript 5.7',
            'Rust 1.82, JavaScript ES2024',
            // C# + JS combos
            'C# 13, JavaScript ES2024',
            'C# 12, TypeScript 5.7',
            'C# 11, JavaScript ES2023',
            // Ruby + JS combos
            'Ruby 3.4, JavaScript ES2024',
            'Ruby 3.3, TypeScript 5.6',
            // Dart + Kotlin combos
            'Dart 3.6, Kotlin 2.1',
            'Dart 3.5, Swift 6.0',
            // Elixir + JS combos
            'Elixir 1.17, JavaScript ES2024',
            'Elixir 1.16, TypeScript 5.5',
            // Scala + JS combos
            'Scala 3.5, TypeScript 5.7',
            'Scala 3.4, JavaScript ES2024',
            // Additional mixed combos
            'PHP 8.4, Dart 3.6',
            'Python 3.13, Kotlin 2.1',
            'Java 23, Kotlin 2.1',
            'Go 1.23, TypeScript 5.6',
            'Rust 1.83, Go 1.23',
            'C# 13, TypeScript 5.6',
            'Ruby 3.4, TypeScript 5.7',
            'Swift 6.0, Kotlin 2.1',
            'PHP 8.3, Swift 5.10',
            'Python 3.12, Dart 3.5',
            'Java 21, Scala 3.5',
            'Go 1.22, Rust 1.82',
            'Kotlin 2.1, JavaScript ES2023',
            'Dart 3.6, JavaScript ES2024',
            'Elixir 1.17, Rust 1.83',
            'Haskell 9.10, JavaScript ES2024',
            'Clojure 1.12, JavaScript ES2023',
            'Groovy 4.0, JavaScript ES2024',
            'Lua 5.4, C# 13',
            'R 4.4, Python 3.13',
            'Perl 5.40, JavaScript ES2024',
            'PHP 8.4, Go 1.23',
            'Python 3.13, Rust 1.83',
            'Java 23, Go 1.23',
            'Kotlin 2.0, Dart 3.5',
            'Swift 5.9, TypeScript 5.5',
            'C# 12, Dart 3.5',
            'Ruby 3.2, TypeScript 5.5',
            'Scala 3.5, Kotlin 2.0',
            'PHP 8.2, Kotlin 2.0',
            'Python 3.11, Swift 5.9',
            'Java 17, Dart 3.4',
            'Go 1.21, JavaScript ES2021',
            'Rust 1.80, TypeScript 5.4',
            'C# 10, JavaScript ES2021',
            'Ruby 3.2, JavaScript ES2022',
            'Elixir 1.16, Rust 1.80',
            'Haskell 9.8, TypeScript 5.4',
            'Groovy 4.0, Kotlin 2.1',
            'Perl 5.38, TypeScript 5.3',
            'R 4.3, JavaScript ES2022',
            'Objective-C 2.0, Swift 6.0',
            'PHP 8.1, Rust 1.82',
            'Python 3.10, Go 1.21',
            'Java 11, TypeScript 5.3',
            'Kotlin 1.9, TypeScript 5.4',
            'Dart 3.4, JavaScript ES2022',
            'Swift 5.9, Dart 3.4',
            'Lua 5.4, JavaScript ES2023',
            'Clojure 1.12, TypeScript 5.5',
            'Scala 3.4, Java 21',
            'PHP 8.4, Elixir 1.17',
            'Python 3.13, Haskell 9.10',
            'Go 1.23, Dart 3.6',
            'Rust 1.83, Swift 6.0',
            'C# 13, Kotlin 2.1',
            'Ruby 3.4, Elixir 1.17',
            'Java 23, Rust 1.83',
            'PHP 8.3, Scala 3.5',
            'Python 3.12, R 4.4',
            'Kotlin 2.1, Swift 6.0',
        ];

        $frameworkCombos = [
            // Laravel versions
            'Laravel 12.0', 'Laravel 11.0', 'Laravel 10.0', 'Laravel 9.0', 'Laravel 8.0',
            // CodeIgniter versions
            'CodeIgniter 4.6', 'CodeIgniter 4.5', 'CodeIgniter 4.4', 'CodeIgniter 3.1',
            // Django versions
            'Django 5.1', 'Django 5.0', 'Django 4.2',
            // Flask versions
            'Flask 3.1', 'Flask 3.0', 'Flask 2.3',
            // FastAPI versions
            'FastAPI 0.115', 'FastAPI 0.110',
            // Next.js versions
            'Next.js 15.1', 'Next.js 14.2', 'Next.js 13.5',
            // Nuxt.js versions
            'Nuxt.js 3.15', 'Nuxt.js 3.12', 'Nuxt.js 3.10',
            // Vue.js versions
            'Vue.js 3.5', 'Vue.js 3.4', 'Vue.js 3.3', 'Vue.js 2.7',
            // React versions
            'React 19.0', 'React 18.3', 'React 18.2',
            // Angular versions
            'Angular 19.0', 'Angular 18.2', 'Angular 17.3', 'Angular 16.2',
            // Svelte/SvelteKit versions
            'SvelteKit 2.12', 'SvelteKit 2.5', 'Svelte 5.0', 'Svelte 4.2',
            // Express.js versions
            'Express.js 5.0', 'Express.js 4.21',
            // NestJS versions
            'NestJS 10.4', 'NestJS 10.3', 'NestJS 9.4',
            // Spring Boot versions
            'Spring Boot 3.4', 'Spring Boot 3.3', 'Spring Boot 3.2', 'Spring Boot 2.7',
            // ASP.NET Core versions
            'ASP.NET Core 9.0', 'ASP.NET Core 8.0', 'ASP.NET Core 7.0',
            // Ruby on Rails versions
            'Rails 7.2', 'Rails 7.1', 'Rails 7.0', 'Rails 6.1',
            // Flutter versions
            'Flutter 3.27', 'Flutter 3.24', 'Flutter 3.22',
            // React Native versions
            'React Native 0.76', 'React Native 0.75', 'React Native 0.74',
            // Gin (Go) versions
            'Gin 1.10', 'Gin 1.9',
            // Fiber (Go) versions
            'Fiber 2.52', 'Fiber 2.51',
            // Echo (Go) versions
            'Echo 4.12', 'Echo 4.11',
            // Ktor versions
            'Ktor 3.0', 'Ktor 2.3',
            // Phoenix (Elixir) versions
            'Phoenix 1.7', 'Phoenix 1.6',
            // Play Framework versions
            'Play Framework 3.0', 'Play Framework 2.9',
            // Vapor (Swift) versions
            'Vapor 4.99', 'Vapor 4.92',
            // Actix (Rust) versions
            'Actix Web 4.9', 'Actix Web 4.6',
            // Rocket (Rust) versions
            'Rocket 0.5',
            // Remix versions
            'Remix 2.15', 'Remix 2.12',
            // Gatsby versions
            'Gatsby 5.13', 'Gatsby 5.12',
            // Astro versions
            'Astro 4.16', 'Astro 4.10',
            // Hono versions
            'Hono 4.6', 'Hono 4.4',
            // Fresh (Deno) versions
            'Fresh 2.0', 'Fresh 1.6',
            // Adonis.js versions
            'AdonisJS 6.14', 'AdonisJS 6.12',
            // Symfony versions
            'Symfony 7.2', 'Symfony 7.1', 'Symfony 6.4',
            // CakePHP versions
            'CakePHP 5.1', 'CakePHP 5.0',
            // Yii versions
            'Yii 3.0', 'Yii 2.0',
            // Slim versions
            'Slim 4.14', 'Slim 4.12',
            // Lumen versions
            'Lumen 10.0', 'Lumen 9.0',
            // Quarkus versions
            'Quarkus 3.17', 'Quarkus 3.15',
            // Micronaut versions
            'Micronaut 4.7', 'Micronaut 4.5',
            // Blazor versions
            'Blazor 9.0', 'Blazor 8.0',
            // MAUI versions
            '.NET MAUI 9.0', '.NET MAUI 8.0',
            // Ionic versions
            'Ionic 8.4', 'Ionic 8.2',
            // Electron versions
            'Electron 33.2', 'Electron 32.2',
            // Tauri versions
            'Tauri 2.1', 'Tauri 2.0',
            // Strapi versions
            'Strapi 5.4', 'Strapi 4.25',
            // Directus versions
            'Directus 11.3', 'Directus 10.13',
            // WordPress versions
            'WordPress 6.7', 'WordPress 6.6',
            // Drupal versions
            'Drupal 11.1', 'Drupal 10.3',
            // Grails versions
            'Grails 6.2', 'Grails 6.1',
            // Sinatra versions
            'Sinatra 4.1', 'Sinatra 4.0',
            // Koa versions
            'Koa 2.15', 'Koa 2.14',
            // Fastify versions
            'Fastify 5.1', 'Fastify 4.28',
            // Hapi versions
            'Hapi 21.3',
            // SolidJS versions
            'SolidStart 1.0', 'Solid.js 1.9',
            // Qwik versions
            'Qwik 1.12', 'Qwik 1.9',
            // Ember.js versions
            'Ember.js 5.12', 'Ember.js 5.8',
            // Backbone.js versions
            'Backbone.js 1.6',
            // Alpine.js + HTMX
            'HTMX 2.0',
            // Deno Fresh
            'Deno Fresh 2.0',
        ];

        $arsitektur = ['monolith', 'be-fe'];

        $libraries = [
            'Bootstrap 5.3, jQuery 3.7, DataTables 2.0, Chart.js 4.4, SweetAlert2 11.0',
            'Tailwind CSS 4.0, Alpine.js 3.14, Livewire 3.5, FilamentPHP 3.2',
            'React 19.0, Redux Toolkit 2.4, Axios 1.7, Material-UI 6.1, React Query 5.0',
            'Vue.js 3.5, Pinia 2.3, Vuetify 3.7, Axios 1.7, VueUse 11.3',
            'Next.js 15.1, Prisma 6.1, NextAuth 5.0, Tailwind CSS 4.0',
            'Bootstrap 5.3, Livewire 3.5, ApexCharts 4.1, Select2 4.1, Toastr 2.1',
            'Tailwind CSS 3.4, Inertia.js 2.0, Ziggy 2.4, Spatie Permissions 6.4',
            'Angular Material 19.0, RxJS 7.8, NgRx 18.0, PrimeNG 18.0',
            'Svelte 5.0, SvelteKit 2.12, Skeleton UI 2.10, Superforms 2.0',
            'Shadcn UI 2.1, Radix UI 1.2, Zustand 5.0, TanStack Query 5.0',
            'Chakra UI 3.2, Framer Motion 11.0, React Hook Form 7.53, Zod 3.23',
            'Ant Design 5.22, Umi.js 4.3, DvaJS 2.6, ProComponents 2.7',
            'Mantine 7.14, React Router 7.0, SWR 2.2, Jotai 2.10',
            'Bulma 1.0, HTMX 2.0, Stimulus 3.2, Turbo 8.0',
            'Flowbite 2.5, DaisyUI 4.12, Heroicons 2.2, Headless UI 2.2',
            'PrimeVue 4.2, VeeValidate 4.14, Vue Router 4.4, Pinia 2.3',
            'Quasar 2.17, Capacitor 6.2, Ionicons 7.4',
            'Nuxt UI 2.20, Nuxt Image 1.8, Nuxt SEO 2.0, VueUse 11.3',
            'Drizzle ORM 0.36, Lucia Auth 3.2, Hono 4.6, Zod 3.23',
            'Sequelize 6.37, Passport.js 0.7, Multer 1.4, Morgan 1.10',
            'TypeORM 0.3.20, Class-Validator 0.14, Swagger 7.4, RxJS 7.8',
            'Mongoose 8.8, Socket.io 4.8, Bull 4.16, Helmet 8.0',
            'SQLAlchemy 2.0, Celery 5.4, Redis-py 5.2, Pydantic 2.10',
            'Spring Security 6.4, Hibernate 6.6, Thymeleaf 3.1, Lombok 1.18',
            'Entity Framework Core 9.0, AutoMapper 13.0, MediatR 12.4, Serilog 4.1',
            'Gorm 1.25, Gorilla Mux 1.8, Viper 1.19, Zap 1.27',
            'Exposed 0.56, Koin 4.0, Arrow 1.2, Coroutines 1.9',
            'Ecto 3.12, Oban 2.18, Tesla 1.12, Phoenix LiveView 1.0',
            'ActiveRecord 7.2, Devise 4.9, Pundit 2.4, Sidekiq 7.3',
            'Diesel 2.2, Serde 1.0, Tokio 1.41, Tower 0.5',
        ];

        $dbmsOptions = [
            ['dbms' => 'MySQL', 'versi' => '8.4.3'],
            ['dbms' => 'PostgreSQL', 'versi' => '17.2'],
            ['dbms' => 'MariaDB', 'versi' => '11.6.2'],
            ['dbms' => 'MySQL', 'versi' => '8.0.40'],
            ['dbms' => 'PostgreSQL', 'versi' => '16.6'],
            ['dbms' => 'SQL Server', 'versi' => '2022'],
            ['dbms' => 'MySQL', 'versi' => '8.3.0'],
            ['dbms' => 'MariaDB', 'versi' => '10.11.8'],
            ['dbms' => 'PostgreSQL', 'versi' => '15.8'],
            ['dbms' => 'SQLite', 'versi' => '3.47'],
            ['dbms' => 'MongoDB', 'versi' => '8.0'],
            ['dbms' => 'MySQL', 'versi' => '9.1.0'],
            ['dbms' => 'PostgreSQL', 'versi' => '14.15'],
            ['dbms' => 'MariaDB', 'versi' => '11.4.4'],
            ['dbms' => 'SQL Server', 'versi' => '2019'],
            ['dbms' => 'Oracle', 'versi' => '23c'],
            ['dbms' => 'MongoDB', 'versi' => '7.0'],
            ['dbms' => 'Redis', 'versi' => '7.4'],
            ['dbms' => 'SQLite', 'versi' => '3.45'],
            ['dbms' => 'MariaDB', 'versi' => '10.6.19'],
        ];

        $penyediaRepo = ['GitHub', 'GitLab', 'Bitbucket', 'Azure DevOps', 'GitHub', 'GitLab'];

        $programmers = [
            "1. Ahmad Rizki - Backend Developer\n2. Budi Santoso - Frontend Developer\n3. Citra Dewi - UI/UX Designer",
            "1. Dian Permata - Full Stack Developer\n2. Eko Prasetyo - DevOps Engineer",
            "1. Fajar Nugroho - System Analyst\n2. Gita Maharani - Software Engineer\n3. Hendra Wijaya - Database Administrator",
            "1. Indah Sari - Project Manager\n2. Joko Susilo - Backend Developer\n3. Kartika Sari - QA Engineer",
            "1. Lukman Hakim - Lead Developer\n2. Maya Anggraini - Frontend Developer",
            "1. Nurul Hidayah - Software Architect\n2. Oki Pratama - Mobile Developer\n3. Putri Wulandari - Tester",
            "1. Rahmad Dani - Full Stack Developer\n2. Sarah Amelia - Frontend Developer\n3. Teguh Widodo - DevOps",
            "1. Umar Faruq - Lead Backend\n2. Vina Oktaviani - UI Designer",
            "1. Wahyu Setiawan - System Engineer\n2. Xena Putri - Software Developer\n3. Yoga Pratama - Security Engineer",
            "1. Zainal Abidin - Project Lead\n2. Aisyah Nur - Data Analyst\n3. Bambang Irawan - Backend Developer",
        ];

        $backupCode = [
            'Auto-commit ke Git repository setiap hari jam 23:00 WIB',
            'Rsync ke cloud storage setiap 6 jam dengan versioning',
            'CI/CD Pipeline otomatis backup ke S3 setiap push ke branch main',
            'Snapshot server harian menggunakan cron job ke NAS lokal',
            'Git push otomatis ke GitLab self-hosted setiap deployment',
            'Backup incremental menggunakan restic ke Backblaze B2 setiap 12 jam',
            'Mirror repository ke GitHub dan GitLab secara otomatis',
        ];

        $backupAsset = [
            'Sinkronisasi ke Google Cloud Storage dengan versioning enabled',
            'Upload otomatis ke AWS S3 bucket dengan lifecycle policy 90 hari',
            'Rsync ke NAS lokal dan cloud backup harian',
            'Backup asset ke MinIO self-hosted dengan retensi 60 hari',
            'CDN cache dengan origin backup di DigitalOcean Spaces',
            'Sync ke Azure Blob Storage dengan redundansi geo-replication',
            'Backup manual mingguan ke external HDD dan cloud storage',
        ];

        $backupDb = [
            'Auto mysqldump setiap jam 00:00 WIB ke cloud storage, retensi 30 hari',
            'pg_dump terjadwal setiap 6 jam dengan rotasi backup 14 hari',
            'Percona XtraBackup harian dengan full backup mingguan',
            'Automated backup via cPanel cron job setiap 12 jam',
            'Database replication master-slave dengan backup harian ke S3',
            'Backup otomatis menggunakan Laravel Backup Package setiap hari',
            'WAL archiving PostgreSQL dengan point-in-time recovery 7 hari',
        ];

        $integrasi = [
            'Integrasi dengan Portal Pekanbaru AMAN, SSO Pemerintah Kota, dan API Gateway Diskominfo',
            'Terhubung dengan Sistem Keuangan SIMDA dan E-Budgeting Kemendagri',
            'Integrasi REST API dengan SIRUP LKPP dan E-Procurement Nasional',
            'Koneksi ke Dukcapil untuk verifikasi NIK dan NIP, serta ke BPJS Kesehatan',
            'Terintegrasi dengan Satu Data Indonesia dan Open Data Pekanbaru',
            'Integrasi webhook dengan WA Gateway, Email SMTP Pemko, dan Telegram Bot',
            'Terhubung ke Dashboard Smart City Pekanbaru dan JDIH Nasional',
        ];

        $monev = [
            'Monitoring menggunakan Grafana dan Prometheus, evaluasi bulanan via dashboard',
            'Uptime monitoring dengan UptimeRobot, laporan kinerja triwulanan',
            'ELK Stack (Elasticsearch, Logstash, Kibana) untuk log monitoring realtime',
            'Google Analytics dan Sentry error tracking, review bulanan',
            'New Relic APM untuk performance monitoring, evaluasi per semester',
            'Monitoring via Laravel Telescope dan Horizon, evaluasi mingguan',
            'Zabbix monitoring infrastruktur, Datadog untuk APM, laporan bulanan',
        ];

        $dbLokasiOptions = ['Server Kominfo', 'Lainnya'];

        $dbms = $dbmsOptions[$i % count($dbmsOptions)];

        return [
            'nama' => $nama,
            'deskripsi' => $deskripsi,
            'alamat_tautan' => $alamatTautan,
            'jenis_aplikasi' => $jenisAplikasi[$i % count($jenisAplikasi)],
            'tim' => $programmers[$i % count($programmers)],
            'email' => "{$code}@pekanbaru.go.id",
            'whatsapp' => '08' . str_pad((string)(11 + ($i * 7) % 89), 2, '0', STR_PAD_LEFT) . str_pad((string)(1000 + ($i * 137) % 9000), 4, '0', STR_PAD_LEFT) . str_pad((string)(1000 + ($i * 251) % 9000), 4, '0', STR_PAD_LEFT),
            'bahasa_pemrograman' => $bahasaCombos[$i % count($bahasaCombos)],
            'arsitektur' => $arsitektur[$i % count($arsitektur)],
            'framework' => $frameworkCombos[$i % count($frameworkCombos)],
            'library' => $libraries[$i % count($libraries)],
            'has_repo' => ($i % 3 !== 2) ? 'ya' : 'tidak',
            'git_type' => ($i % 2 === 0) ? 'private' : 'public',
            'penyedia_repo' => $penyediaRepo[$i % count($penyediaRepo)],
            'backup_code' => $backupCode[$i % count($backupCode)],
            'backup_asset' => $backupAsset[$i % count($backupAsset)],
            'dbms' => $dbms['dbms'],
            'dbms_versi' => $dbms['versi'],
            'db_lokasi' => $dbLokasiOptions[$i % count($dbLokasiOptions)],
            'db_akses' => ($i % 4 === 0) ? 'public' : 'private',
            'backup_db' => $backupDb[$i % count($backupDb)],
            'integrasi' => $integrasi[$i % count($integrasi)],
            'monev' => $monev[$i % count($monev)],
        ];
    }
}


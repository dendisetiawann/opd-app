<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Opd;
use App\Models\WebApp;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class FullWebAppSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create or get an OPD
        $opd = Opd::firstOrCreate(
            ['nama_opd' => 'Dinas Komunikasi dan Informatika'],
            ['alamat' => 'Jl. Jend. Sudirman No. 123, Pekanbaru']
        );

        // Create a test user
        $user = User::create([
            'name' => 'Demo User',
            'email' => 'demo@diskominfo.go.id',
            'password' => Hash::make('password123'),
            'opd_id' => $opd->id,
            'role_id' => 2, // Assuming 2 is user role
        ]);

        // Create a fully filled web app
        WebApp::create([
            'user_id' => $user->id,
            'opd_id' => $opd->id,
            
            // Section 1: Informasi Umum
            'nama_web_app' => 'SIMPEL - Sistem Informasi Pelayanan Publik',
            'deskripsi_singkat' => 'Aplikasi pelayanan publik terpadu untuk masyarakat Kota Pekanbaru. Menyediakan layanan pengaduan, perizinan online, dan informasi publik dalam satu platform terintegrasi.',
            'domain' => 'https://simpel.pekanbaru.go.id',
            
            // Section 2: Tim & Kontak
            'data_tim_programmer' => "1. Andi Wijaya - Lead Developer (Backend)\n2. Sari Dewi - Frontend Developer\n3. Budi Santoso - Mobile Developer\n4. Rina Maharani - UI/UX Designer\n5. Hendra Pratama - Database Administrator",
            'email_narahubung' => 'simpel@diskominfo.pekanbaru.go.id',
            
            // Section 3: Stack Teknologi
            'bahasa_pemrograman' => "Backend: PHP 8.2, Python 3.11\nFrontend: JavaScript ES6, TypeScript 5.0\nMobile: Kotlin (Android), Swift (iOS)",
            'arsitektur_sistem' => 'be-fe',
            'framework' => 'Laravel, Vue.js, Flutter',
            'versi_framework' => 'Laravel 11.x, Vue 3.4, Flutter 3.16',
            'daftar_library_package' => "Backend:\n- Laravel Sanctum v3.3 (API Authentication)\n- Laravel Excel v3.1 (Export Data)\n- Spatie Permission v6.0 (Role Management)\n- Laravel Horizon v5.0 (Queue Monitoring)\n\nFrontend:\n- Tailwind CSS v3.4 (Styling)\n- Axios v1.6 (HTTP Client)\n- Pinia v2.1 (State Management)\n- Chart.js v4.4 (Data Visualization)\n\nMobile:\n- Dio v5.0 (HTTP Client)\n- GetX v4.6 (State Management)\n- Firebase v10.0 (Push Notification)",
            
            // Section 4: Repository & Backup
            'has_repository' => 'ya',
            'git_repository' => 'private',
            'penyedia_repository' => 'GitLab Self-Hosted',
            'metode_backup_source_code' => "1. Git push otomatis ke GitLab internal setiap commit\n2. Backup harian ke Google Cloud Storage pukul 00:00\n3. Backup mingguan ke external HDD offline setiap Jumat\n4. Mirror repository ke GitHub Private sebagai disaster recovery",
            'metode_backup_asset' => "1. Sync otomatis ke NAS lokal setiap 6 jam\n2. Backup harian ke AWS S3 bucket\n3. Backup mingguan ke Google Drive dengan enkripsi AES-256\n4. Arsip bulanan ke external HDD untuk cold storage",
            
            // Section 5: Database
            'nama_database' => 'simpel_production',
            'versi_database' => '8.0',
            'dbms' => 'MySQL',
            'versi_dbms' => '8.0.35',
            'lokasi_database' => 'server',
            'akses_database' => 'private',
            'metode_backup_database' => "1. mysqldump otomatis setiap 6 jam via cron job\n2. Master-Slave replication ke server standby\n3. Point-in-time recovery tersedia hingga 7 hari\n4. Backup bulanan ke offsite location\n5. Testing restore setiap bulan untuk memastikan integritas backup",
            
            // Section 6: Integrasi & Monitoring
            'integrasi_sistem_keluar' => "1. API Dukcapil - Verifikasi NIK dan data kependudukan\n2. SSO Kemendagri - Single Sign-On untuk ASN\n3. Sistem Keuangan Daerah (SIMDA) - Integrasi pembayaran retribusi\n4. E-KTP Reader - Pembacaan data dari KTP elektronik\n5. WhatsApp Business API - Notifikasi status permohonan\n6. Payment Gateway Midtrans - Pembayaran online",
            'metode_monitoring_evaluasi' => "1. Google Analytics 4 - User behavior dan traffic analysis\n2. UptimeRobot - Monitoring uptime 24/7 dengan alert via Telegram\n3. Sentry - Error tracking dan performance monitoring\n4. Grafana + Prometheus - Server metrics dashboard\n5. Weekly report otomatis via email ke stakeholder\n6. User satisfaction survey setiap kuartal\n7. Security audit tahunan oleh pihak ketiga",
        ]);

        $this->command->info('✅ Demo user created:');
        $this->command->info('   Email: demo@diskominfo.go.id');
        $this->command->info('   Password: password123');
        $this->command->info('✅ Fully filled web app (SIMPEL) created successfully!');
    }
}

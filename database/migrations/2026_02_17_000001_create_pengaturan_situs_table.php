<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengaturan_situs', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->enum('type', ['text', 'textarea', 'image'])->default('text');
            $table->string('group')->default('general');
            $table->string('label')->nullable();
            $table->integer('order')->default(0);
            $table->timestamps();
        });

        $now = now();
        $settings = [
            // Global (Logo & Favicon)
            ['key' => 'global_logo', 'value' => 'images/logo-pekanbaru.png', 'type' => 'image', 'group' => 'global', 'label' => 'Logo Utama', 'order' => 1],
            ['key' => 'global_favicon', 'value' => 'images/logo-favicon-192.png', 'type' => 'image', 'group' => 'global', 'label' => 'Favicon', 'order' => 2],
            ['key' => 'global_org_name', 'value' => 'Pemerintah Kota Pekanbaru', 'type' => 'text', 'group' => 'global', 'label' => 'Nama Organisasi', 'order' => 3],
            ['key' => 'global_app_name', 'value' => 'SIDATA', 'type' => 'text', 'group' => 'global', 'label' => 'Nama Aplikasi (Utama)', 'order' => 4],

            ['key' => 'global_app_description', 'value' => 'Sistem Informasi Data Terpadu', 'type' => 'text', 'group' => 'global', 'label' => 'Deskripsi Aplikasi', 'order' => 6],

            // Hero Section
            ['key' => 'hero_title_1', 'value' => 'Sistem Manajemen', 'type' => 'text', 'group' => 'hero', 'label' => 'Judul Baris 1', 'order' => 1],
            ['key' => 'hero_title_2', 'value' => 'Data Aplikasi', 'type' => 'text', 'group' => 'hero', 'label' => 'Judul Baris 2 (Warna)', 'order' => 2],
            ['key' => 'hero_title_3', 'value' => 'Pemerintahan.', 'type' => 'text', 'group' => 'hero', 'label' => 'Judul Baris 3', 'order' => 3],
            ['key' => 'hero_description', 'value' => 'Platform terpadu untuk inventarisasi, pengelolaan, dan standardisasi data aplikasi di seluruh Organisasi Perangkat Daerah (OPD) Kota Pekanbaru. Mewujudkan tata kelola SPBE yang terintegrasi dan akuntabel.', 'type' => 'textarea', 'group' => 'hero', 'label' => 'Deskripsi Hero', 'order' => 4],
            ['key' => 'hero_feature_1', 'value' => 'Terintegrasi', 'type' => 'text', 'group' => 'hero', 'label' => 'Fitur 1', 'order' => 5],
            ['key' => 'hero_feature_2', 'value' => 'Real-time', 'type' => 'text', 'group' => 'hero', 'label' => 'Fitur 2', 'order' => 6],
            ['key' => 'hero_feature_3', 'value' => 'Aman', 'type' => 'text', 'group' => 'hero', 'label' => 'Fitur 3', 'order' => 7],

            // Info Cards
            ['key' => 'info_section_title', 'value' => 'Informasi Sistem', 'type' => 'text', 'group' => 'info_cards', 'label' => 'Judul Seksi', 'order' => 1],
            ['key' => 'info_section_description', 'value' => 'Sistem ini berfungsi sebagai pusat kendali data (Control Center) untuk monitoring perkembangan digitalisasi pemerintahan di lingkungan Kota Pekanbaru.', 'type' => 'textarea', 'group' => 'info_cards', 'label' => 'Deskripsi Seksi', 'order' => 2],
            ['key' => 'card_1_title', 'value' => 'Inventarisasi Aset Digital', 'type' => 'text', 'group' => 'info_cards', 'label' => 'Kartu 1 — Judul', 'order' => 3],
            ['key' => 'card_1_description', 'value' => 'Pendataan lengkap seluruh aplikasi, meliputi aspek teknis, stack teknologi, basis data, hingga status keamanan informasi.', 'type' => 'textarea', 'group' => 'info_cards', 'label' => 'Kartu 1 — Deskripsi', 'order' => 4],
            ['key' => 'card_2_title', 'value' => 'Standarisasi & Kepatuhan', 'type' => 'text', 'group' => 'info_cards', 'label' => 'Kartu 2 — Judul', 'order' => 5],
            ['key' => 'card_2_description', 'value' => 'Memastikan pengembangan aplikasi sesuai dengan standar arsitektur SPBE dan interoperabilitas data pemerintah daerah.', 'type' => 'textarea', 'group' => 'info_cards', 'label' => 'Kartu 2 — Deskripsi', 'order' => 6],
            ['key' => 'card_3_title', 'value' => 'Monitoring Eksekutif', 'type' => 'text', 'group' => 'info_cards', 'label' => 'Kartu 3 — Judul', 'order' => 7],
            ['key' => 'card_3_description', 'value' => 'Dashboard eksekutif untuk pimpinan daerah memantau kinerja dan efektivitas implementasi teknologi di setiap perangkat daerah.', 'type' => 'textarea', 'group' => 'info_cards', 'label' => 'Kartu 3 — Deskripsi', 'order' => 8],

            // Footer
            ['key' => 'footer_org_name', 'value' => 'DISKOMINFO', 'type' => 'text', 'group' => 'footer', 'label' => 'Nama Organisasi', 'order' => 1],
            ['key' => 'footer_org_sub', 'value' => 'KOTA PEKANBARU', 'type' => 'text', 'group' => 'footer', 'label' => 'Sub Organisasi', 'order' => 2],
            ['key' => 'footer_address', 'value' => 'Dinas Komunikasi, Informatika, Statistik dan Persandian Kota Pekanbaru. Bencah Lesung, Kec. Tenayan Raya, Kota Pekanbaru, Riau.', 'type' => 'textarea', 'group' => 'footer', 'label' => 'Alamat', 'order' => 3],
            ['key' => 'footer_phone', 'value' => '(0761) 123456', 'type' => 'text', 'group' => 'footer', 'label' => 'Telepon', 'order' => 4],
            ['key' => 'footer_email', 'value' => 'diskominfo@pekanbaru.go.id', 'type' => 'text', 'group' => 'footer', 'label' => 'Email', 'order' => 5],
            ['key' => 'footer_link_1_text', 'value' => 'Portal Pekanbaru', 'type' => 'text', 'group' => 'footer', 'label' => 'Link 1 — Teks', 'order' => 6],
            ['key' => 'footer_link_1_url', 'value' => '#', 'type' => 'text', 'group' => 'footer', 'label' => 'Link 1 — URL', 'order' => 7],
            ['key' => 'footer_link_2_text', 'value' => 'PPID Kota Pekanbaru', 'type' => 'text', 'group' => 'footer', 'label' => 'Link 2 — Teks', 'order' => 8],
            ['key' => 'footer_link_2_url', 'value' => '#', 'type' => 'text', 'group' => 'footer', 'label' => 'Link 2 — URL', 'order' => 9],
            ['key' => 'footer_link_3_text', 'value' => 'Layanan Pengaduan', 'type' => 'text', 'group' => 'footer', 'label' => 'Link 3 — Teks', 'order' => 10],
            ['key' => 'footer_link_3_url', 'value' => '#', 'type' => 'text', 'group' => 'footer', 'label' => 'Link 3 — URL', 'order' => 11],
            ['key' => 'footer_version', 'value' => 'Versi 1.0.0', 'type' => 'text', 'group' => 'footer', 'label' => 'Versi Aplikasi', 'order' => 12],
            ['key' => 'footer_copyright', 'value' => 'Pemerintah Kota Pekanbaru. All rights reserved.', 'type' => 'text', 'group' => 'footer', 'label' => 'Teks Hak Cipta', 'order' => 13],

            // Login Page
            ['key' => 'login_title', 'value' => 'Selamat Datang Kembali', 'type' => 'text', 'group' => 'login', 'label' => 'Judul Halaman Login', 'order' => 1],
            ['key' => 'login_description', 'value' => 'Silahkan masuk ke akun Anda untuk mengakses dashboard manajemen aplikasi.', 'type' => 'textarea', 'group' => 'login', 'label' => 'Deskripsi Login', 'order' => 2],
            ['key' => 'login_panel_title', 'value' => 'Sistem Manajemen Data Aplikasi', 'type' => 'text', 'group' => 'login', 'label' => 'Judul Panel Kanan', 'order' => 3],
            ['key' => 'login_panel_description', 'value' => 'Platform untuk pengelolaan aset digital dan inventarisasi aplikasi di lingkungan Pemerintah Kota Pekanbaru. Mendukung tata kelola SPBE yang lebih baik.', 'type' => 'textarea', 'group' => 'login', 'label' => 'Deskripsi Panel Kanan', 'order' => 4],
            ['key' => 'login_copyright', 'value' => 'DISKOMINFO Kota Pekanbaru', 'type' => 'text', 'group' => 'login', 'label' => 'Teks Hak Cipta', 'order' => 5],

            // Register Page
            ['key' => 'register_title', 'value' => 'Daftar Akun Baru', 'type' => 'text', 'group' => 'register', 'label' => 'Judul Halaman Register', 'order' => 1],
            ['key' => 'register_description', 'value' => 'Buat akun untuk mengakses sistem manajemen data aplikasi OPD.', 'type' => 'textarea', 'group' => 'register', 'label' => 'Deskripsi Register', 'order' => 2],
            ['key' => 'register_panel_title', 'value' => 'Sistem Manajemen Data Aplikasi', 'type' => 'text', 'group' => 'register', 'label' => 'Judul Panel Kanan', 'order' => 3],
            ['key' => 'register_panel_description', 'value' => 'Platform terintegrasi untuk pengelolaan aset digital dan inventarisasi aplikasi di lingkungan Pemerintah Kota Pekanbaru.', 'type' => 'textarea', 'group' => 'register', 'label' => 'Deskripsi Panel Kanan', 'order' => 4],
            ['key' => 'register_feature_1', 'value' => 'Kelola data aplikasi OPD Anda', 'type' => 'text', 'group' => 'register', 'label' => 'Fitur 1', 'order' => 5],
            ['key' => 'register_feature_2', 'value' => 'Pantau status dan integrasi sistem', 'type' => 'text', 'group' => 'register', 'label' => 'Fitur 2', 'order' => 6],
            ['key' => 'register_feature_3', 'value' => 'Dokumentasi lengkap & terstruktur', 'type' => 'text', 'group' => 'register', 'label' => 'Fitur 3', 'order' => 7],
            ['key' => 'register_copyright', 'value' => 'DISKOMINFO Kota Pekanbaru', 'type' => 'text', 'group' => 'register', 'label' => 'Teks Hak Cipta', 'order' => 8],

            // Dashboard User
            ['key' => 'dashboard_user_description', 'value' => 'Lihat dan tambahkan data inventarisasi aplikasi', 'type' => 'textarea', 'group' => 'dashboard_user', 'label' => 'Deskripsi Dashboard', 'order' => 1],
            ['key' => 'dashboard_user_copyright', 'value' => 'Sistem Manajemen Data Aplikasi - DISKOMINFO Kota Pekanbaru', 'type' => 'text', 'group' => 'dashboard_user', 'label' => 'Teks Hak Cipta', 'order' => 2],

            // Dashboard Admin
            ['key' => 'dashboard_admin_description', 'value' => 'Pantau dan kelola seluruh inventaris aplikasi Pemerintah Kota Pekanbaru dalam satu dashboard terintegrasi yang modern dan efisien.', 'type' => 'textarea', 'group' => 'dashboard_admin', 'label' => 'Deskripsi Dashboard', 'order' => 1],
            ['key' => 'dashboard_admin_copyright', 'value' => 'Sistem Manajemen Data Aplikasi - DISKOMINFO Kota Pekanbaru', 'type' => 'text', 'group' => 'dashboard_admin', 'label' => 'Teks Hak Cipta', 'order' => 2],
        ];

        foreach ($settings as $s) {
            DB::table('pengaturan_situs')->insert(array_merge($s, [
                'created_at' => $now,
                'updated_at' => $now,
            ]));
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('pengaturan_situs');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi - Buat semua tabel sistem.
     *
     * Tabel Aplikasi:
     *   1. opd                - Data Organisasi Perangkat Daerah
     *   2. pengguna           - Data pengguna sistem (role: admin/user)
     *   3. token_reset_sandi  - Token untuk reset password
     *   4. sesi               - Data sesi pengguna aktif
     *   5. aplikasi_web       - Data aplikasi web yang didaftarkan OPD
     *   6. log_aktivitas      - Catatan aktivitas/audit trail
     *   7. otp_pendaftaran    - OTP untuk verifikasi pendaftaran
     *
     * Tabel Sistem Laravel (tidak diubah):
     *   - cache, cache_locks  - Cache framework
     *   - jobs, job_batches, failed_jobs - Antrian pekerjaan
     */
    public function up(): void
    {
        // ============================================================
        // 1. TABEL OPD (Organisasi Perangkat Daerah)
        // ============================================================
        Schema::create('opd', function (Blueprint $table) {
            $table->id();
            $table->string('nama_opd')->unique();
            $table->timestamps();
        });

        // ============================================================
        // 2. TABEL PENGGUNA (users)
        // ============================================================
        Schema::create('pengguna', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('role', ['admin', 'user'])->default('user');
            $table->foreignId('opd_id')->constrained('opd')->onDelete('cascade');
            $table->string('profile_photo')->nullable();
            $table->timestamp('last_login_at')->nullable();
            $table->string('last_login_ip')->nullable();
            $table->string('last_login_device')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        // ============================================================
        // 4. TABEL TOKEN RESET SANDI (password_reset_tokens)
        // ============================================================
        Schema::create('token_reset_sandi', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        // ============================================================
        // 5. TABEL SESI (sessions)
        // ============================================================
        Schema::create('sesi', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });

        // ============================================================
        // 6. TABEL CACHE (Laravel System - tidak diubah)
        // ============================================================
        Schema::create('cache', function (Blueprint $table) {
            $table->string('key')->primary();
            $table->mediumText('value');
            $table->integer('expiration')->index();
        });

        Schema::create('cache_locks', function (Blueprint $table) {
            $table->string('key')->primary();
            $table->string('owner');
            $table->integer('expiration')->index();
        });

        // ============================================================
        // 7. TABEL ANTRIAN PEKERJAAN (Laravel System - tidak diubah)
        // ============================================================
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->string('queue')->index();
            $table->longText('payload');
            $table->unsignedTinyInteger('attempts');
            $table->unsignedInteger('reserved_at')->nullable();
            $table->unsignedInteger('available_at');
            $table->unsignedInteger('created_at');
        });

        Schema::create('job_batches', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('name');
            $table->integer('total_jobs');
            $table->integer('pending_jobs');
            $table->integer('failed_jobs');
            $table->longText('failed_job_ids');
            $table->mediumText('options')->nullable();
            $table->integer('cancelled_at')->nullable();
            $table->integer('created_at');
            $table->integer('finished_at')->nullable();
        });

        Schema::create('failed_jobs', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->text('connection');
            $table->text('queue');
            $table->longText('payload');
            $table->longText('exception');
            $table->timestamp('failed_at')->useCurrent();
        });

        // ============================================================
        // 8. TABEL APLIKASI WEB (web_apps)
        // ============================================================
        Schema::create('aplikasi_web', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('pengguna')->onDelete('cascade');
            $table->foreignId('opd_id')->constrained('opd')->onDelete('cascade');

            // Informasi Umum (WAJIB)
            $table->string('nama_web_app');
            $table->text('deskripsi_singkat');
            $table->string('alamat_tautan');

            // Tim & Kontak (WAJIB)
            $table->text('data_tim_programmer');
            $table->string('email_narahubung');
            $table->string('whatsapp_narahubung');

            // Teknologi (WAJIB)
            $table->text('bahasa_pemrograman');
            $table->enum('arsitektur_sistem', ['monolith', 'be-fe'])->default('monolith');
            $table->string('framework');
            $table->text('daftar_library_package');

            // Repository & Backup (WAJIB)
            $table->enum('has_repository', ['ya', 'tidak']);
            $table->string('git_repository', 20)->nullable();
            $table->string('penyedia_repository', 100)->nullable();
            $table->text('metode_backup_source_code');
            $table->text('metode_backup_asset');

            // Database (WAJIB)
            $table->string('dbms');
            $table->string('versi_dbms');
            $table->enum('lokasi_database', ['Server Kominfo', 'Lainnya']);
            $table->enum('akses_database', ['public', 'private']);
            $table->text('metode_backup_database');

            // Integrasi & Monev (OPSIONAL)
            $table->text('integrasi_sistem_keluar')->nullable();
            $table->text('metode_monitoring_evaluasi')->nullable();

            $table->timestamps();
        });

        // ============================================================
        // 9. TABEL LOG AKTIVITAS (activity_logs)
        // ============================================================
        Schema::create('log_aktivitas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('pengguna')->onDelete('set null');
            $table->unsignedBigInteger('admin_id')->nullable();
            $table->string('action');
            $table->text('old_value')->nullable();
            $table->text('new_value')->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->string('user_agent')->nullable();
            $table->timestamps();

            $table->foreign('admin_id')->references('id')->on('pengguna')->onDelete('set null');
        });

        // ============================================================
        // 10. TABEL OTP PENDAFTARAN (registration_otps)
        // ============================================================
        Schema::create('otp_pendaftaran', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('otp', 6);
            $table->string('name');
            $table->string('password');
            $table->foreignId('opd_id')->nullable()->constrained('opd')->onDelete('set null');
            $table->boolean('verified')->default(false);
            $table->timestamp('expires_at');
            $table->timestamp('last_sent_at')->nullable();
            $table->timestamps();

            $table->index(['email', 'otp']);
        });
    }

    /**
     * Batalkan migrasi - Hapus semua tabel (urutan terbalik).
     */
    public function down(): void
    {
        Schema::dropIfExists('otp_pendaftaran');
        Schema::dropIfExists('log_aktivitas');
        Schema::dropIfExists('aplikasi_web');
        Schema::dropIfExists('failed_jobs');
        Schema::dropIfExists('job_batches');
        Schema::dropIfExists('jobs');
        Schema::dropIfExists('cache_locks');
        Schema::dropIfExists('cache');
        Schema::dropIfExists('sesi');
        Schema::dropIfExists('token_reset_sandi');
        Schema::dropIfExists('pengguna');
        Schema::dropIfExists('opd');
    }
};

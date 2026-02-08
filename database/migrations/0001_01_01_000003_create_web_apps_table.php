<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('web_apps', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('opd_id')->constrained('opds')->onDelete('cascade');
            
            // Informasi Umum (WAJIB)
            $table->string('nama_web_app');
            $table->text('deskripsi_singkat');
            $table->string('alamat_tautan');
            
            // Tim & Kontak (WAJIB)
            $table->text('data_tim_programmer');
            $table->string('email_narahubung');
            
            // Teknologi (WAJIB)
            $table->text('bahasa_pemrograman');
            $table->enum('arsitektur_sistem', ['monolith', 'be-fe'])->default('monolith');
            $table->string('framework');
            $table->text('daftar_library_package');
            
            // Repository & Backup (WAJIB)
            $table->enum('has_repository', ['ya', 'tidak']);
            $table->enum('git_repository', ['public', 'private']);
            $table->string('penyedia_repository', 100);
            $table->text('metode_backup_source_code');
            $table->text('metode_backup_asset');
            
            // Database (WAJIB)
            $table->string('nama_database');
            $table->string('versi_database');
            $table->string('dbms');
            $table->string('versi_dbms');
            $table->enum('lokasi_database', ['local', 'server']);
            $table->enum('akses_database', ['public', 'private']);
            $table->text('metode_backup_database');
            
            // Integrasi & Monev (OPSIONAL)
            $table->text('integrasi_sistem_keluar')->nullable();
            $table->text('metode_monitoring_evaluasi')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('web_apps');
    }
};

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
            
            // Informasi Umum
            $table->string('nama_web_app');
            $table->text('deskripsi_singkat')->nullable();
            $table->string('domain')->nullable();
            
            // Tim & Kontak
            $table->text('data_tim_programmer')->nullable();
            $table->string('email_narahubung')->nullable();
            
            // Teknologi
            $table->string('bahasa_backend')->nullable();
            $table->string('versi_backend')->nullable();
            $table->string('bahasa_frontend')->nullable();
            $table->string('versi_frontend')->nullable();
            $table->enum('arsitektur_sistem', ['monolith', 'be-fe'])->default('monolith');
            $table->string('framework')->nullable();
            $table->string('versi_framework')->nullable();
            $table->text('daftar_library_package')->nullable();
            
            // Repository & Backup
            $table->enum('git_repository', ['public', 'private'])->nullable();
            $table->text('metode_backup_source_code')->nullable();
            $table->text('metode_backup_asset')->nullable();
            
            // Database
            $table->string('nama_database')->nullable();
            $table->string('versi_database')->nullable();
            $table->string('dbms')->nullable();
            $table->string('versi_dbms')->nullable();
            $table->enum('lokasi_database', ['local', 'server'])->nullable();
            $table->enum('akses_database', ['public', 'private'])->nullable();
            $table->text('metode_backup_database')->nullable();
            
            // Integrasi & Monev
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

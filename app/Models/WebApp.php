<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WebApp extends Model
{
    protected $fillable = [
        'user_id',
        'opd_id',
        // Informasi Umum
        'nama_web_app',
        'deskripsi_singkat',
        'domain',
        // Tim & Kontak
        'data_tim_programmer',
        'email_narahubung',
        // Stack Teknologi
        'bahasa_backend',
        'versi_backend',
        'bahasa_frontend',
        'versi_frontend',
        'bahasa_pemrograman',
        'arsitektur_sistem',
        'framework',
        'versi_framework',
        'daftar_library_package',
        // Repository & Backup
        'git_repository',
        'link_github',
        'metode_backup_source_code',
        'metode_backup_asset',
        // Database
        'nama_database',
        'versi_database',
        'dbms',
        'versi_dbms',
        'lokasi_database',
        'akses_database',
        'metode_backup_database',
        // Integrasi & Monev
        'integrasi_sistem_keluar',
        'metode_monitoring_evaluasi',
    ];

    /**
     * Get the user that owns this web app.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the OPD that owns this web app.
     */
    public function opd(): BelongsTo
    {
        return $this->belongsTo(Opd::class);
    }
}

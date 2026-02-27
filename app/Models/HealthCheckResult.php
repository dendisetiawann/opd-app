<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HealthCheckResult extends Model
{
    protected $fillable = [
        'batch_id', 'web_app_id', 'nama_web_app', 'nama_opd',
        'url', 'http_code', 'status', 'response_time_ms'
    ];

    public function batch()
    {
        return $this->belongsTo(HealthCheckBatch::class, 'batch_id', 'batch_id');
    }

    public function webApp()
    {
        return $this->belongsTo(WebApp::class, 'web_app_id');
    }

    /**
     * Get human-readable HTTP status code description in Indonesian
     */
    public static function httpCodeDescription(int $code): string
    {
        $descriptions = [
            0   => 'Timeout — Server tidak merespons dalam batas waktu',
            200 => 'OK — Website aktif dan berjalan normal',
            201 => 'Created — Server merespons, resource berhasil dibuat',
            202 => 'Accepted — Permintaan diterima, sedang diproses',
            204 => 'No Content — Server merespons tanpa konten',
            301 => 'Moved Permanently — Website dialihkan ke URL baru secara permanen',
            302 => 'Found — Website dialihkan sementara ke URL lain',
            303 => 'See Other — Lihat resource di URL lain',
            304 => 'Not Modified — Konten tidak berubah sejak terakhir diakses',
            307 => 'Temporary Redirect — Dialihkan sementara ke URL lain',
            308 => 'Permanent Redirect — Dialihkan permanen ke URL lain',
            400 => 'Bad Request — Permintaan tidak valid',
            401 => 'Unauthorized — Memerlukan autentikasi',
            403 => 'Forbidden — Akses ditolak oleh server',
            404 => 'Not Found — Halaman tidak ditemukan',
            405 => 'Method Not Allowed — Metode HTTP tidak diizinkan',
            408 => 'Request Timeout — Permintaan melebihi batas waktu',
            429 => 'Too Many Requests — Terlalu banyak permintaan',
            500 => 'Internal Server Error — Terjadi kesalahan internal di server',
            502 => 'Bad Gateway — Server perantara mendapat respons tidak valid',
            503 => 'Service Unavailable — Server sedang tidak tersedia / maintenance',
            504 => 'Gateway Timeout — Server perantara tidak mendapat respons',
            521 => 'Web Server Down — Server web tidak aktif',
            522 => 'Connection Timed Out — Koneksi ke server habis waktu',
            523 => 'Origin Unreachable — Server asal tidak dapat dijangkau',
            524 => 'A Timeout Occurred — Terjadi timeout pada koneksi',
        ];

        return $descriptions[$code] ?? "HTTP {$code} — Kode status tidak dikenal";
    }

    /**
     * Short label for the HTTP code
     */
    public static function httpCodeLabel(int $code): string
    {
        $labels = [
            0 => 'Timeout', 200 => 'OK', 201 => 'Created', 202 => 'Accepted',
            204 => 'No Content', 301 => 'Moved', 302 => 'Redirect', 303 => 'See Other',
            304 => 'Not Modified', 307 => 'Temp Redirect', 308 => 'Perm Redirect',
            400 => 'Bad Request', 401 => 'Unauthorized', 403 => 'Forbidden',
            404 => 'Not Found', 405 => 'Method Not Allowed', 408 => 'Timeout',
            429 => 'Too Many Requests', 500 => 'Server Error', 502 => 'Bad Gateway',
            503 => 'Unavailable', 504 => 'Gateway Timeout', 521 => 'Server Down',
            522 => 'Conn Timeout', 523 => 'Unreachable', 524 => 'Timeout',
        ];

        return $labels[$code] ?? "HTTP {$code}";
    }
}

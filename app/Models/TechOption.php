<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TechOption extends Model
{
    protected $table = 'opsi_teknologi';

    protected $fillable = ['kategori', 'nama', 'versi'];

    /**
     * Scope by kategori.
     */
    public function scopeByKategori($query, string $kategori)
    {
        return $query->where('kategori', $kategori);
    }

    /**
     * Get grouped data: [{ name: 'PHP', versions: ['8.4', '8.3'] }, ...]
     */
    public static function groupedByName(string $kategori): array
    {
        $rows = static::byKategori($kategori)
            ->select('nama', 'versi')
            ->orderBy('nama')
            ->orderByDesc('versi')
            ->get();

        $grouped = [];
        foreach ($rows as $row) {
            if (!isset($grouped[$row->nama])) {
                $grouped[$row->nama] = [];
            }
            $grouped[$row->nama][] = $row->versi;
        }

        $result = [];
        foreach ($grouped as $name => $versions) {
            $result[] = ['name' => $name, 'versions' => $versions];
        }

        return $result;
    }

    /**
     * Insert new tech options from form submission, ignoring duplicates.
     */
    public static function syncFromSubmission(string $kategori, string $nama, string $versi): void
    {
        if (empty($nama) || empty($versi)) return;

        static::insertOrIgnore([
            'kategori' => $kategori,
            'nama' => trim($nama),
            'versi' => trim($versi),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}

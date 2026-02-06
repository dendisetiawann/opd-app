<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreWebAppRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // Informasi Umum
            'nama_web_app' => 'required|string|max:255',
            'deskripsi_singkat' => 'required|string',
            'domain' => 'required|string|max:255',
            
            // Tim & Kontak
            'data_tim_programmer' => 'required|string',
            'email_narahubung' => 'required|string|max:255',
            
            // Stack Teknologi
            'bahasa_pemrograman' => 'required|string',
            'arsitektur_sistem' => 'required|in:monolith,be-fe',
            'framework' => 'required|string|max:255',
            // 'versi_framework' => 'nullable|string|max:50', // Deprecated: combined into framework
            'daftar_library_package' => 'required|string',
            
            // Repository & Backup
            'has_repository' => 'required|in:ya,tidak',
            'git_repository' => 'required_if:has_repository,ya|nullable|in:public,private',
            'penyedia_repository' => 'required_if:has_repository,ya|nullable|string|max:100',
            'metode_backup_source_code' => 'required|string',
            'metode_backup_asset' => 'required|string',
            
            // Database
            'nama_database' => 'required|string|max:100',
            'versi_database' => 'required|string|max:50',
            'dbms' => 'required|string|max:100',
            'versi_dbms' => 'required|string|max:50',
            'lokasi_database' => 'required|in:local,server',
            'akses_database' => 'required|in:public,private',
            'metode_backup_database' => 'required|string',
            
            // Integrasi & Monev (Tetap Nullable)
            'integrasi_sistem_keluar' => 'nullable|string',
            'metode_monitoring_evaluasi' => 'nullable|string',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            // Informasi Umum
            'nama_web_app.required' => 'Nama aplikasi wajib diisi.',
            'nama_web_app.max' => 'Nama aplikasi maksimal 255 karakter.',
            'domain.required' => 'Alamat website/link aplikasi wajib diisi.',
            
            // Tim & Kontak
            'email_narahubung.max' => 'Kontak/email maksimal 255 karakter.',
            
            // Stack Teknologi
            'bahasa_pemrograman.required' => 'Bahasa pemrograman wajib diisi.',
            'arsitektur_sistem.required' => 'Arsitektur sistem wajib dipilih.',
            'arsitektur_sistem.in' => 'Arsitektur sistem harus monolith atau be-fe.',
            'framework.required' => 'Framework wajib diisi.',
            'daftar_library_package.required' => 'Daftar library/package wajib diisi.',
            
            // Repository & Backup
            'has_repository.in' => 'Pilihan repository harus ya atau tidak.',
            'git_repository.in' => 'Status repository harus public atau private.',
            
            // Database
            'lokasi_database.in' => 'Lokasi DBMS harus local atau server.',
            'akses_database.in' => 'Akses database harus public atau private.',
        ];
    }
}

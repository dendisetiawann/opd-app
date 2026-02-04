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
            'email_narahubung' => 'required|email|max:255',
            
            // Stack Teknologi
            'bahasa_pemrograman' => 'required|string',
            'arsitektur_sistem' => 'required|in:monolith,be-fe',
            'framework' => 'required|string|max:100',
            'versi_framework' => 'required|string|max:50',
            'daftar_library_package' => 'required|string',
            
            // Repository & Backup
            'git_repository' => 'required|in:public,private',
            'link_github' => 'required|url|max:500',
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
            
            // Integrasi & Monev
            'integrasi_sistem_keluar' => 'required|string',
            'metode_monitoring_evaluasi' => 'required|string',
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
            'deskripsi_singkat.required' => 'Deskripsi singkat wajib diisi.',
            'domain.required' => 'Domain wajib diisi.',
            
            // Tim & Kontak
            'data_tim_programmer.required' => 'Data tim programmer wajib diisi.',
            'email_narahubung.required' => 'Email narahubung wajib diisi.',
            'email_narahubung.email' => 'Format email tidak valid.',
            
            // Stack Teknologi
            'bahasa_pemrograman.required' => 'Bahasa pemrograman wajib diisi.',
            'arsitektur_sistem.required' => 'Arsitektur sistem wajib dipilih.',
            'arsitektur_sistem.in' => 'Arsitektur sistem harus monolith atau be-fe.',
            'framework.required' => 'Framework wajib diisi.',
            'versi_framework.required' => 'Versi framework wajib diisi.',
            'daftar_library_package.required' => 'Daftar library/package wajib diisi.',
            
            // Repository & Backup
            'git_repository.required' => 'Status Git repository wajib dipilih.',
            'git_repository.in' => 'Git repository harus public atau private.',
            'link_github.required' => 'Link GitHub repository wajib diisi.',
            'link_github.url' => 'Link GitHub harus berupa URL yang valid.',
            'metode_backup_source_code.required' => 'Metode backup source code wajib diisi.',
            'metode_backup_asset.required' => 'Metode backup asset wajib diisi.',
            
            // Database
            'nama_database.required' => 'Nama database wajib diisi.',
            'versi_database.required' => 'Versi database wajib diisi.',
            'dbms.required' => 'DBMS wajib diisi.',
            'versi_dbms.required' => 'Versi DBMS wajib diisi.',
            'lokasi_database.required' => 'Lokasi database wajib dipilih.',
            'lokasi_database.in' => 'Lokasi database harus local atau server.',
            'akses_database.required' => 'Akses database wajib dipilih.',
            'akses_database.in' => 'Akses database harus public atau private.',
            'metode_backup_database.required' => 'Metode backup database wajib diisi.',
            
            // Integrasi & Monev
            'integrasi_sistem_keluar.required' => 'Integrasi sistem keluar wajib diisi.',
            'metode_monitoring_evaluasi.required' => 'Metode monitoring & evaluasi wajib diisi.',
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateWebAppRequest extends FormRequest
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
            'deskripsi_singkat' => 'nullable|string',
            'alamat_tautan' => 'required|string|max:255',
            
            // Tim & Kontak
            'data_tim_programmer' => 'nullable|string',
            'email_narahubung' => 'nullable|string|max:255',
            
            // Stack Teknologi
            'bahasa_pemrograman' => 'required|string',
            'arsitektur_sistem' => 'required|in:monolith,be-fe',
            'framework' => 'required|string|max:255',
            // 'versi_framework' => 'required|string|max:50', // Deprecated
            'daftar_library_package' => 'required|string',
            
            // Repository & Backup
            'has_repository' => 'nullable|in:ya,tidak',
            'git_repository' => 'nullable|in:public,private',
            'penyedia_repository' => 'nullable|string|max:100',
            'metode_backup_source_code' => 'nullable|string',
            'metode_backup_asset' => 'nullable|string',
            
            // Database
            'nama_database' => 'nullable|string|max:100',
            'versi_database' => 'nullable|string|max:50',
            'dbms' => 'nullable|string|max:100',
            'versi_dbms' => 'nullable|string|max:50',
            'lokasi_database' => 'nullable|in:local,server',
            'akses_database' => 'nullable|in:public,private',
            'metode_backup_database' => 'nullable|string',
            
            // Integrasi & Monev
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
            'nama_web_app.required' => 'Nama aplikasi wajib diisi.',
            'nama_web_app.max' => 'Nama aplikasi maksimal 255 karakter.',
            'alamat_tautan.required' => 'Alamat website/link aplikasi wajib diisi.',
            'arsitektur_sistem.in' => 'Arsitektur sistem harus monolith atau be-fe.',
            'has_repository.in' => 'Pilihan repository harus ya atau tidak.',
            'git_repository.in' => 'Status repository harus public atau private.',
            'lokasi_database.in' => 'Lokasi DBMS harus local atau server.',
            'akses_database.in' => 'Akses database harus public atau private.',
        ];
    }
}

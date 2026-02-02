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
            'deskripsi_singkat' => 'nullable|string',
            'domain' => 'nullable|string|max:255',
            
            // Tim & Kontak
            'data_tim_programmer' => 'nullable|string',
            'email_narahubung' => 'nullable|email|max:255',
            
            // Teknologi
            'bahasa_backend' => 'nullable|string|max:100',
            'versi_backend' => 'nullable|string|max:50',
            'bahasa_frontend' => 'nullable|string|max:100',
            'versi_frontend' => 'nullable|string|max:50',
            'arsitektur_sistem' => 'nullable|in:monolith,be-fe',
            'framework' => 'nullable|string|max:100',
            'versi_framework' => 'nullable|string|max:50',
            'daftar_library_package' => 'nullable|string',
            
            // Repository & Backup
            'git_repository' => 'nullable|in:public,private',
            'link_github' => 'nullable|url|max:500',
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
            'email_narahubung.email' => 'Format email tidak valid.',
            'arsitektur_sistem.in' => 'Arsitektur sistem harus monolith atau be-fe.',
            'git_repository.in' => 'Git repository harus public atau private.',
            'lokasi_database.in' => 'Lokasi database harus local atau server.',
            'akses_database.in' => 'Akses database harus public atau private.',
        ];
    }
}

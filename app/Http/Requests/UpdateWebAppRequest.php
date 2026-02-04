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
            'nama_web_app.required' => 'Nama aplikasi wajib diisi.',
            'nama_web_app.max' => 'Nama aplikasi maksimal 255 karakter.',
            'email_narahubung.email' => 'Format email tidak valid.',
            'arsitektur_sistem.in' => 'Arsitektur sistem harus monolith atau be-fe.',
            'git_repository.in' => 'Git repository harus public atau private.',
            'link_github.url' => 'Link GitHub harus berupa URL yang valid.',
            'lokasi_database.in' => 'Lokasi database harus local atau server.',
            'akses_database.in' => 'Akses database harus public atau private.',
        ];
    }
}

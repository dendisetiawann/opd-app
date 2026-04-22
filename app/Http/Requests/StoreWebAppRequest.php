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
            'alamat_tautan' => 'required|string|max:255',
            'jenis_aplikasi' => 'required|string|max:100',
            
            // Tim & Kontak
            'data_tim_programmer' => 'required|string',
            'email_narahubung' => 'required|string|max:255',
            'whatsapp_narahubung' => 'required|string|max:255',
            
            // Stack Teknologi
            'bahasa_pemrograman' => 'required|string',
            'arsitektur_sistem' => 'required|in:monolith,be-fe',
            'framework' => 'required|string|max:255',
            // 'versi_framework' => 'nullable|string|max:50', // Deprecated: combined into framework
            'daftar_library_package' => 'nullable|string',
            
            // Repository & Backup
            'has_repository' => 'required|in:ya,tidak',
            'git_repository' => 'required_if:has_repository,ya|nullable|in:public,private',
            'penyedia_repository' => 'required_if:has_repository,ya|nullable|string|max:100',
            'metode_backup_source_code' => 'required|string',
            'metode_backup_asset' => 'required|string',
            
            // Database
            'dbms' => 'required|string|max:100',
            'versi_dbms' => 'required|string|max:50',
            'lokasi_database' => 'required|in:Server Kominfo,Lainnya',
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
            'deskripsi_singkat.required' => 'Deskripsi singkat kegunaan wajib diisi.',
            'alamat_tautan.required' => 'Alamat tautan/URL wajib diisi.',
            'alamat_tautan.max' => 'Alamat tautan maksimal 255 karakter.',
            'jenis_aplikasi.required' => 'Jenis aplikasi wajib dipilih.',
            
            // Tim & Kontak
            'data_tim_programmer.required' => 'Data tim pengembang wajib diisi.',
            'email_narahubung.required' => 'Email narahubung wajib diisi.',
            'email_narahubung.max' => 'Email narahubung maksimal 255 karakter.',
            'whatsapp_narahubung.required' => 'Nomor WhatsApp wajib diisi.',
            'whatsapp_narahubung.max' => 'Nomor WhatsApp maksimal 255 karakter.',
            
            // Stack Teknologi
            'bahasa_pemrograman.required' => 'Bahasa pemrograman wajib diisi (tambahkan minimal satu).',
            'arsitektur_sistem.required' => 'Arsitektur sistem wajib dipilih.',
            'arsitektur_sistem.in' => 'Arsitektur sistem harus Monolith atau Backend-Frontend.',
            'framework.required' => 'Framework wajib diisi (tambahkan minimal satu).',
            'daftar_library_package.required' => 'Library/Package wajib diisi (tambahkan minimal satu).',
            
            // Repository & Backup
            'has_repository.required' => 'Pilihan penggunaan repository wajib dipilih.',
            'has_repository.in' => 'Pilihan repository harus Ya atau Tidak.',
            'git_repository.required_if' => 'Status repository (Public/Private) wajib dipilih.',
            'git_repository.in' => 'Status repository harus Public atau Private.',
            'penyedia_repository.required_if' => 'Penyedia repository wajib diisi.',
            'metode_backup_source_code.required' => 'Metode backup source code wajib diisi.',
            'metode_backup_asset.required' => 'Metode backup aset wajib diisi.',
            
            // Database
            'dbms.required' => 'Jenis DBMS wajib diisi (pilih dari daftar).',
            'versi_dbms.required' => 'Versi DBMS wajib diisi.',
            'lokasi_database.required' => 'Lokasi database wajib dipilih.',
            'lokasi_database.in' => 'Lokasi DBMS harus Server Kominfo atau Lainnya.',
            'akses_database.required' => 'Akses database wajib dipilih.',
            'akses_database.in' => 'Akses database harus Public atau Private.',
            'metode_backup_database.required' => 'Metode backup database wajib diisi.',
        ];
    }
}

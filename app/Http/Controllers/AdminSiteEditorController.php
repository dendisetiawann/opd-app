<?php

namespace App\Http\Controllers;

use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminSiteEditorController extends Controller
{
    /**
     * Show the site editor page with settings grouped by page.
     */
    public function index()
    {
        $pages = [
            'global' => [
                'title' => 'Global',
                'description' => 'Pengaturan yang berlaku di semua halaman.',
                'icon' => 'M12 21a9.004 9.004 0 008.716-6.747M12 21a9.004 9.004 0 01-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 017.843 4.582M12 3a8.997 8.997 0 00-7.843 4.582m15.686 0A11.953 11.953 0 0112 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0121 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0112 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 013 12c0-1.605.42-3.113 1.157-4.418',
                'activeClass' => 'bg-indigo-600 text-white border-indigo-600',
                'bannerClass' => 'bg-indigo-50 text-indigo-600',
                'sections' => [
                    'global_images' => [
                        'title' => 'Logo & Favicon',
                        'description' => 'Logo utama dan ikon browser yang digunakan di semua halaman.',
                        'icon' => 'M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909M3.75 21h16.5A2.25 2.25 0 0022.5 18.75V5.25A2.25 2.25 0 0020.25 3H3.75A2.25 2.25 0 001.5 5.25v13.5A2.25 2.25 0 003.75 21z',
                        'colorClass' => 'bg-indigo-50 text-indigo-600',
                        'settings' => SiteSetting::getGroup('global'),
                    ],
                ],
            ],
            'landing' => [
                'title' => 'Landing Page',
                'description' => 'Konten halaman utama publik — hero, kartu informasi, dan footer.',
                'icon' => 'M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25',
                'activeClass' => 'bg-blue-600 text-white border-blue-600',
                'bannerClass' => 'bg-blue-50 text-blue-600',
                'sections' => [
                    'hero' => [
                        'title' => 'Hero Section',
                        'description' => 'Judul besar, deskripsi, dan fitur unggulan.',
                        'icon' => 'M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z',
                        'colorClass' => 'bg-blue-50 text-blue-600',
                        'settings' => SiteSetting::getGroup('hero'),
                    ],
                    'info_cards' => [
                        'title' => 'Kartu Informasi',
                        'description' => 'Tiga kartu informasi di bawah hero.',
                        'icon' => 'M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z',
                        'colorClass' => 'bg-purple-50 text-purple-600',
                        'settings' => SiteSetting::getGroup('info_cards'),
                    ],
                    'footer' => [
                        'title' => 'Footer',
                        'description' => 'Kontak, pranala luar, dan versi.',
                        'icon' => 'M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25',
                        'colorClass' => 'bg-amber-50 text-amber-600',
                        'settings' => SiteSetting::getGroup('footer'),
                    ],
                ],
            ],
            'login' => [
                'title' => 'Halaman Login',
                'description' => 'Teks pada halaman masuk — judul, deskripsi, dan panel kanan.',
                'icon' => 'M15.75 5.25a3 3 0 013 3m3 0a6 6 0 01-7.029 5.912c-.563-.097-1.159.026-1.563.43L10.5 17.25H8.25v2.25H6v2.25H2.25v-2.818c0-.597.237-1.17.659-1.591l6.499-6.499c.404-.404.527-1 .43-1.563A6 6 0 1121.75 8.25z',
                'activeClass' => 'bg-emerald-600 text-white border-emerald-600',
                'bannerClass' => 'bg-emerald-50 text-emerald-600',
                'sections' => [
                    'login_content' => [
                        'title' => 'Konten Login',
                        'description' => 'Judul, deskripsi, panel kanan, dan hak cipta.',
                        'icon' => 'M15.75 5.25a3 3 0 013 3m3 0a6 6 0 01-7.029 5.912c-.563-.097-1.159.026-1.563.43L10.5 17.25H8.25v2.25H6v2.25H2.25v-2.818c0-.597.237-1.17.659-1.591l6.499-6.499c.404-.404.527-1 .43-1.563A6 6 0 1121.75 8.25z',
                        'colorClass' => 'bg-emerald-50 text-emerald-600',
                        'settings' => SiteSetting::getGroup('login'),
                    ],
                ],
            ],
            'register' => [
                'title' => 'Halaman Register',
                'description' => 'Teks pada halaman pendaftaran — judul, deskripsi, panel kanan, dan fitur.',
                'icon' => 'M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z',
                'activeClass' => 'bg-cyan-600 text-white border-cyan-600',
                'bannerClass' => 'bg-cyan-50 text-cyan-600',
                'sections' => [
                    'register_content' => [
                        'title' => 'Konten Register',
                        'description' => 'Judul, deskripsi, panel kanan, fitur, dan hak cipta.',
                        'icon' => 'M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z',
                        'colorClass' => 'bg-cyan-50 text-cyan-600',
                        'settings' => SiteSetting::getGroup('register'),
                    ],
                ],
            ],
            'dashboard_user' => [
                'title' => 'Dashboard User',
                'description' => 'Teks pada dashboard pengguna OPD.',
                'icon' => 'M2.25 7.125C2.25 6.504 2.754 6 3.375 6h6c.621 0 1.125.504 1.125 1.125v3.75c0 .621-.504 1.125-1.125 1.125h-6a1.125 1.125 0 01-1.125-1.125v-3.75zM14.25 8.625c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125v8.25c0 .621-.504 1.125-1.125 1.125h-5.25a1.125 1.125 0 01-1.125-1.125v-8.25zM3.75 16.125c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125v2.25c0 .621-.504 1.125-1.125 1.125h-5.25a1.125 1.125 0 01-1.125-1.125v-2.25z',
                'activeClass' => 'bg-sky-600 text-white border-sky-600',
                'bannerClass' => 'bg-sky-50 text-sky-600',
                'sections' => [
                    'dashboard_user_content' => [
                        'title' => 'Konten Dashboard',
                        'description' => 'Deskripsi sambutan dan hak cipta.',
                        'icon' => 'M2.25 7.125C2.25 6.504 2.754 6 3.375 6h6c.621 0 1.125.504 1.125 1.125v3.75c0 .621-.504 1.125-1.125 1.125h-6a1.125 1.125 0 01-1.125-1.125v-3.75zM14.25 8.625c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125v8.25c0 .621-.504 1.125-1.125 1.125h-5.25a1.125 1.125 0 01-1.125-1.125v-8.25zM3.75 16.125c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125v2.25c0 .621-.504 1.125-1.125 1.125h-5.25a1.125 1.125 0 01-1.125-1.125v-2.25z',
                        'colorClass' => 'bg-sky-50 text-sky-600',
                        'settings' => SiteSetting::getGroup('dashboard_user'),
                    ],
                ],
            ],
            'dashboard_admin' => [
                'title' => 'Dashboard Admin',
                'description' => 'Teks pada dashboard administrator.',
                'icon' => 'M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75',
                'activeClass' => 'bg-rose-600 text-white border-rose-600',
                'bannerClass' => 'bg-rose-50 text-rose-600',
                'sections' => [
                    'dashboard_admin_content' => [
                        'title' => 'Konten Dashboard',
                        'description' => 'Deskripsi sambutan dan hak cipta.',
                        'icon' => 'M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75',
                        'colorClass' => 'bg-rose-50 text-rose-600',
                        'settings' => SiteSetting::getGroup('dashboard_admin'),
                    ],
                ],
            ],
        ];

        // Default open sections: first section of each page
        $defaultOpenSections = [];
        foreach ($pages as $page) {
            foreach ($page['sections'] as $sectionKey => $section) {
                $defaultOpenSections[] = $sectionKey;
                break; // only first section
            }
        }

        return view('admin.site-editor.index', compact('pages', 'defaultOpenSections'));
    }

    /**
     * Render a preview of a specific page (read-only, no auth redirect).
     */
    public function preview(string $page)
    {
        switch ($page) {
            case 'landing':
                return view('welcome');
            case 'login':
                return view('auth.login');
            case 'register':
                return view('auth.register');
            case 'dashboard_user':
                $webApps = collect();
                $totalApps = 0;
                // Render dashboard content inside a minimal preview layout
                $content = view('dashboard-preview', compact('webApps', 'totalApps'))->render();
                return $this->previewWrapper($content);
            case 'dashboard_admin':
                $totalApps = 0;
                $totalOpds = 0;
                $appsThisMonth = 0;
                $recentApps = collect();
                $content = view('admin.dashboard-preview', compact('totalApps', 'totalOpds', 'appsThisMonth', 'recentApps'))->render();
                return $this->previewWrapper($content);
            default:
                return view('welcome');
        }
    }

    /**
     * Wrap preview content in a minimal HTML page (no sidebar).
     */
    private function previewWrapper(string $content)
    {
        return response('<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Preview</title>
    <link rel="icon" href="' . asset(SiteSetting::get('global_favicon', 'images/logo-favicon-192.png')) . '" type="image/png">
    ' . app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']) . '
</head>
<body class="font-sans antialiased bg-gray-100">
    <div class="p-6">' . $content . '</div>
</body>
</html>');
    }

    /**
     * Update all site settings at once.
     */
    public function update(Request $request)
    {
        $settings = $request->input('settings', []);

        // Capture old values for audit log
        $oldValues = [];
        $newValues = [];
        foreach ($settings as $key => $value) {
            $oldValues[$key] = SiteSetting::get($key);
            $newValues[$key] = $value;
            SiteSetting::set($key, $value);
        }

        SiteSetting::clearCache();

        // Audit log: site_updated
        if (!empty($settings)) {
            \App\Models\ActivityLog::create([
                'admin_id' => auth()->id(),
                'action' => 'site_updated',
                'old_value' => json_encode($oldValues, JSON_UNESCAPED_UNICODE),
                'new_value' => json_encode($newValues, JSON_UNESCAPED_UNICODE),
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);
        }

        return redirect()->route('admin.site-editor.index')
            ->with('success', 'Konten halaman berhasil diperbarui!');
    }

    /**
     * Upload an image for a site setting.
     */
    public function uploadImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:png,jpg,jpeg,webp,svg|max:2048',
            'key' => 'required|string|exists:pengaturan_situs,key',
        ]);

        $file = $request->file('image');
        $filename = 'site_' . $request->key . '_' . time() . '.' . $file->getClientOriginalExtension();

        // Store in public/images/site/
        $file->move(public_path('images/site'), $filename);

        $path = 'images/site/' . $filename;

        // Update the setting
        SiteSetting::set($request->key, $path);
        SiteSetting::clearCache();

        return redirect()->route('admin.site-editor.index')
            ->with('success', 'Gambar berhasil diupload!');
    }
}

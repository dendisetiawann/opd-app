<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreWebAppRequest;
use App\Http\Requests\UpdateWebAppRequest;
use App\Models\TechOption;
use App\Models\WebApp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class WebAppController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of user's web apps.
     */
    public function index()
    {
        $user = Auth::user();
        $filter = request('filter', 'mine'); // default to 'mine'
        
        // Count for tabs
        $myAppsCount = $user->webApps()->count();
        $opdAppsCount = WebApp::where('opd_id', $user->opd_id)->count();
        
        // Total apps in OPD (including user's own)
        $totalOpdAppsCount = WebApp::where('opd_id', $user->opd_id)->count();
        
        // Build query based on filter
        if ($filter === 'opd') {
            // Show ALL apps from same OPD (including current user's apps)
            $query = WebApp::with(['opd', 'user'])
                ->where('opd_id', $user->opd_id)
                ->latest();
        } else {
            // Default: show only user's own apps
            $query = $user->webApps()->with('opd')->latest();
        }

        if (request('search')) {
            $query->where('nama_web_app', 'like', '%' . request('search') . '%');
        }

        $webApps = $query->paginate(10)->withQueryString();

        return view('web-apps.index', compact('webApps', 'filter', 'myAppsCount', 'opdAppsCount', 'totalOpdAppsCount'));
    }

    /**
     * Show the form for creating a new web app.
     */
    public function create()
    {
        $techData = [
            'langOptions' => TechOption::groupedByName('bahasa'),
            'fwOptions' => TechOption::groupedByName('framework'),
            'libOptions' => TechOption::groupedByName('library'),
            'dbmsOptions' => TechOption::groupedByName('dbms'),
        ];

        return view('web-apps.create', $techData);
    }

    /**
     * Store a newly created web app in storage.
     */
    public function store(StoreWebAppRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = Auth::id();
        $data['opd_id'] = Auth::user()->opd_id;

        // Set empty string for nullable fields that database doesn't allow NULL
        $nullableFields = ['git_repository', 'penyedia_repository', 'integrasi_sistem_keluar', 'metode_monitoring_evaluasi', 'daftar_library_package'];
        foreach ($nullableFields as $field) {
            if (!isset($data[$field]) || $data[$field] === null) {
                $data[$field] = '';
            }
        }

        $webApp = WebApp::create($data);

        // Auto-save new tech entries to opsi_teknologi
        $this->syncTechOptions($data);

        // Audit log: app_created
        \App\Models\ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'app_created',
            'new_value' => json_encode([
                'nama' => $webApp->nama_web_app,
                'url' => $webApp->url_web_app ?? '',
                'framework' => $webApp->framework ?? '',
            ]),
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);

        return redirect()
            ->route('web-apps.index')
            ->with('success', 'Aplikasi berhasil ditambahkan.');
    }

    /**
     * Display the specified web app.
     */
    public function show(WebApp $webApp)
    {
        $this->authorize('view', $webApp);
        $webApp->load(['user', 'opd']);

        return view('web-apps.show', compact('webApp'));
    }

    /**
     * Show the form for editing the specified web app.
     */
    public function edit(WebApp $webApp)
    {
        $this->authorize('update', $webApp);

        $techData = [
            'langOptions' => TechOption::groupedByName('bahasa'),
            'fwOptions' => TechOption::groupedByName('framework'),
            'libOptions' => TechOption::groupedByName('library'),
            'dbmsOptions' => TechOption::groupedByName('dbms'),
        ];

        return view('web-apps.edit', compact('webApp') + $techData);
    }

    /**
     * Update the specified web app in storage.
     */
    public function update(UpdateWebAppRequest $request, WebApp $webApp)
    {
        $this->authorize('update', $webApp);

        $data = $request->validated();
        
        // Set empty string for nullable fields that database doesn't allow NULL
        $nullableFields = ['git_repository', 'penyedia_repository', 'integrasi_sistem_keluar', 'metode_monitoring_evaluasi', 'daftar_library_package'];
        foreach ($nullableFields as $field) {
            if (!isset($data[$field]) || $data[$field] === null) {
                $data[$field] = '';
            }
        }

        // Capture old values before update
        $oldValues = [
            'nama' => $webApp->nama_web_app,
            'url' => $webApp->url_web_app ?? '',
            'framework' => $webApp->framework ?? '',
        ];

        $webApp->update($data);

        // Auto-save new tech entries to opsi_teknologi
        $this->syncTechOptions($data);

        // Audit log: app_updated
        \App\Models\ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'app_updated',
            'old_value' => json_encode($oldValues),
            'new_value' => json_encode([
                'nama' => $webApp->nama_web_app,
                'url' => $webApp->url_web_app ?? '',
                'framework' => $webApp->framework ?? '',
            ]),
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);

        return redirect()
            ->route('web-apps.show', $webApp)
            ->with('success', 'Aplikasi berhasil diperbarui.');
    }

    /**
     * Remove the specified web app from storage.
     */
    public function destroy(WebApp $webApp)
    {
        $this->authorize('delete', $webApp);

        // Audit log: app_deleted
        \App\Models\ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'app_deleted',
            'old_value' => json_encode([
                'nama' => $webApp->nama_web_app,
                'url' => $webApp->url_web_app ?? '',
                'framework' => $webApp->framework ?? '',
            ]),
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);

        $webApp->delete();

        return redirect()
            ->route('web-apps.index')
            ->with('success', 'Aplikasi berhasil dihapus.');
    }

    /**
     * Sync new tech entries from form submission to opsi_teknologi table.
     */
    private function syncTechOptions(array $data): void
    {
        // Sync bahasa_pemrograman (format: "PHP 8.4, JavaScript ES2024")
        if (!empty($data['bahasa_pemrograman'])) {
            $items = array_map('trim', explode(',', $data['bahasa_pemrograman']));
            foreach ($items as $item) {
                if (preg_match('/^(.+?)\s+([\d\.]+\S*)$/', $item, $m)) {
                    TechOption::syncFromSubmission('bahasa', $m[1], $m[2]);
                }
            }
        }

        // Sync framework (format: "Laravel 12.0, Vue.js 3.5")
        if (!empty($data['framework'])) {
            $items = array_map('trim', explode(',', $data['framework']));
            foreach ($items as $item) {
                if (preg_match('/^(.+?)\s+([\d\.]+\S*)$/', $item, $m)) {
                    TechOption::syncFromSubmission('framework', $m[1], $m[2]);
                }
            }
        }

        // Sync library (format: "Livewire 3.5, Axios 1.7")
        if (!empty($data['daftar_library_package'])) {
            $items = array_map('trim', explode(',', $data['daftar_library_package']));
            foreach ($items as $item) {
                if (preg_match('/^(.+?)\s+([\d\.]+\S*)$/', $item, $m)) {
                    TechOption::syncFromSubmission('library', $m[1], $m[2]);
                }
            }
        }

        // Sync DBMS (single value)
        if (!empty($data['dbms']) && !empty($data['versi_dbms'])) {
            TechOption::syncFromSubmission('dbms', $data['dbms'], $data['versi_dbms']);
        }
    }
}

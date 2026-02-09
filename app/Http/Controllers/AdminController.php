<?php

namespace App\Http\Controllers;

use App\Models\Opd;
use App\Models\WebApp;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display admin dashboard with statistics.
     */
    public function dashboard()
    {
        $totalApps = WebApp::count();
        $totalOpds = Opd::count();
        $appsThisMonth = WebApp::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();
        $recentApps = WebApp::with(['user', 'opd'])
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('totalApps', 'totalOpds', 'appsThisMonth', 'recentApps'));
    }

    /**
     * Display all web apps with optional OPD filter and sorting.
     */
    public function index(Request $request)
    {
        $query = WebApp::with(['user', 'opd']);

        // Filter by OPD if provided
        if ($request->filled('opd_id')) {
            $query->where('opd_id', $request->opd_id);
        }

        // Search by app name or OPD name
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_web_app', 'like', '%' . $search . '%')
                  ->orWhereHas('opd', function ($opd) use ($search) {
                      $opd->where('nama_opd', 'like', '%' . $search . '%');
                  });
            });
        }

        // Filter by technology fields (from monitoring stats)
        // Framework & bahasa use LIKE (monitoring normalizes names)
        // Other fields use exact match (monitoring uses raw values)
        if ($request->has('framework')) {
            $val = $request->framework;
            if ($val === '' || $val === null) {
                $query->where(function($q) { $q->whereNull('framework')->orWhere('framework', ''); });
            } else {
                // LIKE for framework because monitoring normalizes names
                $query->whereRaw('LOWER(framework) LIKE ?', ['%' . strtolower($val) . '%']);
            }
        }
        if ($request->has('bahasa_pemrograman')) {
            $val = $request->bahasa_pemrograman;
            if ($val === '' || $val === null) {
                $query->where(function($q) { $q->whereNull('bahasa_pemrograman')->orWhere('bahasa_pemrograman', ''); });
            } else {
                // LIKE for bahasa because monitoring normalizes names
                $query->whereRaw('LOWER(bahasa_pemrograman) LIKE ?', ['%' . strtolower($val) . '%']);
            }
        }
        if ($request->has('dbms')) {
            $val = $request->dbms;
            if ($val === '' || $val === null) {
                $query->where(function($q) { $q->whereNull('dbms')->orWhere('dbms', ''); });
            } else {
                $query->whereRaw('LOWER(dbms) = ?', [strtolower($val)]);
            }
        }
        if ($request->has('arsitektur_sistem')) {
            $val = $request->arsitektur_sistem;
            if ($val === '' || $val === null) {
                $query->where(function($q) { $q->whereNull('arsitektur_sistem')->orWhere('arsitektur_sistem', ''); });
            } else {
                $query->whereRaw('LOWER(arsitektur_sistem) = ?', [strtolower($val)]);
            }
        }
        if ($request->has('has_repository')) {
            $val = $request->has_repository;
            if ($val === 'ya') {
                $query->where('has_repository', 'ya');
            } else {
                $query->where(function($q) {
                    $q->whereNull('has_repository')->orWhere('has_repository', '!=', 'ya');
                });
            }
        }
        if ($request->has('git_repository')) {
            $val = $request->git_repository;
            if ($val === '' || $val === null) {
                $query->where(function($q) { $q->whereNull('git_repository')->orWhere('git_repository', ''); });
            } else {
                $query->whereRaw('LOWER(git_repository) = ?', [strtolower($val)]);
            }
        }
        if ($request->has('penyedia_repository')) {
            $val = $request->penyedia_repository;
            if ($val === '' || $val === null) {
                $query->where(function($q) { $q->whereNull('penyedia_repository')->orWhere('penyedia_repository', ''); });
            } else {
                $query->whereRaw('LOWER(penyedia_repository) = ?', [strtolower($val)]);
            }
        }
        if ($request->has('lokasi_database')) {
            $val = $request->lokasi_database;
            if ($val === '' || $val === null) {
                $query->where(function($q) { $q->whereNull('lokasi_database')->orWhere('lokasi_database', ''); });
            } else {
                $query->whereRaw('LOWER(lokasi_database) = ?', [strtolower($val)]);
            }
        }
        if ($request->has('akses_database')) {
            $val = $request->akses_database;
            if ($val === '' || $val === null) {
                $query->where(function($q) { $q->whereNull('akses_database')->orWhere('akses_database', ''); });
            } else {
                $query->whereRaw('LOWER(akses_database) = ?', [strtolower($val)]);
            }
        }
        if ($request->has('versi_dbms')) {
            $val = $request->versi_dbms;
            if ($val === '' || $val === null) {
                $query->where(function($q) { $q->whereNull('versi_dbms')->orWhere('versi_dbms', ''); });
            } else {
                $query->whereRaw('LOWER(versi_dbms) = ?', [strtolower($val)]);
            }
        }

        // Sorting
        $sort = $request->get('sort', 'name_asc');
        switch ($sort) {
            case 'oldest':
                $query->oldest();
                break;
            case 'name_asc':
                $query->orderBy('nama_web_app', 'asc');
                break;
            case 'name_desc':
                $query->orderBy('nama_web_app', 'desc');
                break;
            case 'newest':
            default:
                $query->latest();
                break;
        }

        $webApps = $query->paginate(11);
        $opds = Opd::orderBy('nama_opd')->get();

        return view('admin.web-apps.index', compact('webApps', 'opds'));
    }

    /**
     * Display a specific web app detail.
     */
    public function show(WebApp $webApp)
    {
        $webApp->load(['user', 'opd']);
        return view('admin.web-apps.show', compact('webApp'));
    }
}

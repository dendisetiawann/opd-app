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

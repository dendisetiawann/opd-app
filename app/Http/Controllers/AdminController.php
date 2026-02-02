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
     * Display all web apps with optional OPD filter.
     */
    public function index(Request $request)
    {
        $query = WebApp::with(['user', 'opd']);

        // Filter by OPD if provided
        if ($request->filled('opd_id')) {
            $query->where('opd_id', $request->opd_id);
        }

        // Search by name
        if ($request->filled('search')) {
            $query->where('nama_web_app', 'like', '%' . $request->search . '%');
        }

        $webApps = $query->latest()->paginate(15);
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

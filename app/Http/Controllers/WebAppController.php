<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreWebAppRequest;
use App\Http\Requests\UpdateWebAppRequest;
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
        return view('web-apps.create');
    }

    /**
     * Store a newly created web app in storage.
     */
    public function store(StoreWebAppRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = Auth::id();
        $data['opd_id'] = Auth::user()->opd_id;

        WebApp::create($data);

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

        return view('web-apps.edit', compact('webApp'));
    }

    /**
     * Update the specified web app in storage.
     */
    public function update(UpdateWebAppRequest $request, WebApp $webApp)
    {
        $this->authorize('update', $webApp);

        $webApp->update($request->validated());

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

        $webApp->delete();

        return redirect()
            ->route('web-apps.index')
            ->with('success', 'Aplikasi berhasil dihapus.');
    }
}

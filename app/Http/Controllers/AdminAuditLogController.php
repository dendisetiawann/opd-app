<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Illuminate\Http\Request;

class AdminAuditLogController extends Controller
{
    /**
     * Display the audit log index page with filters.
     */
    public function index(Request $request)
    {
        $query = ActivityLog::with(['user', 'admin'])->latest();

        // Search by user or admin name
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->whereHas('user', function ($uq) use ($search) {
                    $uq->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                })->orWhereHas('admin', function ($aq) use ($search) {
                    $aq->where('name', 'like', "%{$search}%");
                });
            });
        }

        // Filter by action type
        if ($request->filled('action')) {
            $query->where('action', $request->action);
        }

        // Handle preset date ranges
        if ($request->filled('preset')) {
            $today = now()->format('Y-m-d');
            [$dateFrom, $dateTo] = match($request->preset) {
                'today' => [$today, $today],
                'yesterday' => [now()->subDay()->format('Y-m-d'), now()->subDay()->format('Y-m-d')],
                '7d' => [now()->subDays(6)->format('Y-m-d'), $today],
                '30d' => [now()->subDays(29)->format('Y-m-d'), $today],
                '1y' => [now()->subYear()->format('Y-m-d'), $today],
                default => [null, null],
            };
            if ($dateFrom) $query->whereDate('created_at', '>=', $dateFrom);
            if ($dateTo) $query->whereDate('created_at', '<=', $dateTo);
        } else {
            // Filter by custom date range
            if ($request->filled('date_from')) {
                $query->whereDate('created_at', '>=', $request->date_from);
            }
            if ($request->filled('date_to')) {
                $query->whereDate('created_at', '<=', $request->date_to);
            }
        }

        $logs = $query->get();

        // Group logs by date (e.g., '2026-02-20')
        $groupedLogs = $logs->groupBy(function ($log) {
            return $log->created_at->format('Y-m-d');
        });

        // All possible action types (hardcoded so dropdown always shows all options)
        $actionTypes = collect([
            'login' => 'Login',
            'logout' => 'Logout',
            'user_created' => 'User Dibuat',
            'email_updated' => 'Email Diubah',
            'password_reset' => 'Password Direset',
            'user_deleted' => 'User Dihapus',
            'app_created' => 'Aplikasi Ditambah',
            'app_updated' => 'Aplikasi Diubah',
            'app_deleted' => 'Aplikasi Dihapus',
            'profile_updated' => 'Profil Diubah',
            'profile_photo_updated' => 'Foto Profil Diubah',
            'site_updated' => 'Situs Diubah',
        ]);

        $totalLogs = ActivityLog::count();

        return view('admin.audit-log.index', compact('groupedLogs', 'actionTypes', 'totalLogs'));
    }
}

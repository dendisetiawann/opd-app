<?php

namespace App\Http\Controllers;

use App\Models\WebApp;
use App\Models\User;
use App\Models\Opd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserMonitoringController extends Controller
{
    /**
     * Get the OPD ID of the authenticated user.
     */
    private function getOpdId()
    {
        return auth()->user()->opd_id;
    }

    /**
     * Base query scoped to user's OPD.
     */
    private function scopedQuery()
    {
        return WebApp::where('opd_id', $this->getOpdId());
    }

    /**
     * Monitoring Overview Dashboard (scoped to user's OPD)
     */
    public function index(Request $request)
    {
        $opdId = $this->getOpdId();
        $opd = Opd::find($opdId);

        // Summary stats for overview (scoped to OPD)
        $stats = [
            'total_apps' => $this->scopedQuery()->count(),
            'total_users' => User::where('opd_id', $opdId)->count(),
            'apps_with_repo' => $this->scopedQuery()->where(function($q) {
                $q->whereNotNull('penyedia_repository')->orWhereNotNull('git_repository');
            })->count(),
        ];

        // Known frameworks for smart extraction
        $knownFrameworks = [
            'laravel', 'codeigniter', 'ci', 'yii', 'yii2', 'symfony', 'cakephp', 'slim', 'lumen', 'phalcon', 'zend',
            'vue', 'vuejs', 'vue.js', 'react', 'reactjs', 'react.js', 'angular', 'angularjs', 'svelte', 'alpine', 'alpinejs',
            'next', 'nextjs', 'next.js', 'nuxt', 'nuxtjs', 'nuxt.js', 'gatsby', 'remix', 'astro',
            'express', 'expressjs', 'fastify', 'nestjs', 'nest.js', 'adonisjs',
            'bootstrap', 'tailwind', 'tailwindcss', 'bulma', 'materialize', 'material ui',
            'jquery', 'django', 'flask', 'fastapi', 'spring', 'springboot', 'spring boot',
            'asp.net', '.net', 'blazor', 'rails', 'ruby on rails',
            'flutter', 'react native', 'ionic',
            'wordpress', 'drupal', 'joomla',
            'native', 'vanilla', 'custom', 'tidak ada', 'lainnya'
        ];

        $frameworkCounts = [];
        $this->scopedQuery()->whereNotNull('framework')->pluck('framework')->each(function ($value) use (&$frameworkCounts, $knownFrameworks) {
            $items = preg_split('/[,;\n\r]+|\s+dan\s+|\s+and\s+|\s*&\s*/i', $value);
            foreach ($items as $item) {
                $item = trim($item);
                if (!$item) continue;
                $found = false;
                foreach ($knownFrameworks as $fw) {
                    if (preg_match('/\b(' . preg_quote($fw, '/') . ')\s*([\d\.]+)?/i', $item, $matches)) {
                        $name = ucfirst(strtolower($matches[1]));
                        $frameworkCounts[$name] = ($frameworkCounts[$name] ?? 0) + 1;
                        $found = true;
                        break;
                    }
                }
                if (!$found && $item) {
                    $frameworkCounts[$item] = ($frameworkCounts[$item] ?? 0) + 1;
                }
            }
        });
        arsort($frameworkCounts);
        $topFrameworks = collect(array_slice($frameworkCounts, 0, 10, true))
            ->map(fn($total, $name) => (object)['framework' => $name, 'total' => $total]);

        // Known programming languages
        $knownLanguages = [
            'php', 'javascript', 'js', 'typescript', 'ts', 'html', 'html5', 'css', 'css3', 'sass', 'scss',
            'python', 'java', 'c#', 'csharp', 'c++', 'cpp', 'go', 'golang', 'rust', 'ruby', 'swift', 'kotlin', 'dart',
            'sql', 'mysql', 'postgresql', 'sqlite',
            'tidak diketahui', 'lainnya', 'other', 'unknown', 'tidak ada', '-'
        ];

        $bahasaCounts = [];
        $this->scopedQuery()->whereNotNull('bahasa_pemrograman')->pluck('bahasa_pemrograman')->each(function ($value) use (&$bahasaCounts, $knownLanguages) {
            $items = preg_split('/[,;\n\r]+|\s+dan\s+|\s+and\s+|\s*&\s*/i', $value);
            foreach ($items as $item) {
                $item = trim($item);
                if (!$item) continue;
                $found = false;
                foreach ($knownLanguages as $lang) {
                    if (preg_match('/\b(' . preg_quote($lang, '/') . ')\s*([\d\.]+)?/i', $item, $matches)) {
                        $name = strtoupper($matches[1]);
                        if (in_array(strtolower($matches[1]), ['javascript', 'typescript', 'python', 'java', 'golang', 'ruby', 'swift', 'kotlin', 'dart', 'html', 'css'])) {
                            $name = ucfirst(strtolower($matches[1]));
                        }
                        $bahasaCounts[$name] = ($bahasaCounts[$name] ?? 0) + 1;
                        $found = true;
                        break;
                    }
                }
                if (!$found && $item) {
                    $bahasaCounts[$item] = ($bahasaCounts[$item] ?? 0) + 1;
                }
            }
        });
        arsort($bahasaCounts);
        $bahasaStats = collect(array_slice($bahasaCounts, 0, 10, true))
            ->map(fn($total, $name) => (object)['bahasa_pemrograman' => $name, 'total' => $total]);

        // DBMS stats
        $dbmsCounts = [];
        $this->scopedQuery()->whereNotNull('dbms')->pluck('dbms')->each(function ($value) use (&$dbmsCounts) {
            $items = preg_split('/[,;\n\r]+|\s+dan\s+|\s+and\s+|\s*&\s*/i', $value);
            foreach ($items as $item) {
                $item = trim($item);
                if ($item) {
                    $dbmsCounts[$item] = ($dbmsCounts[$item] ?? 0) + 1;
                }
            }
        });
        arsort($dbmsCounts);
        $dbmsStats = collect(array_slice($dbmsCounts, 0, 10, true))
            ->map(fn($total, $name) => (object)['dbms' => $name, 'total' => $total]);

        // Architecture distribution
        $arsitekturStats = $this->scopedQuery()
            ->select('arsitektur_sistem', DB::raw('count(*) as total'))
            ->groupBy('arsitektur_sistem')
            ->get();

        // Repository Stats
        $punyaRepo = $this->scopedQuery()->where(function($q) {
            $q->whereNotNull('penyedia_repository')->orWhereNotNull('git_repository');
        })->count();
        $tidakRepo = $stats['total_apps'] - $punyaRepo;
        $hasRepoStats = collect([
            (object)['has_repository' => 'ya', 'total' => $punyaRepo],
            (object)['has_repository' => 'tidak', 'total' => $tidakRepo],
        ]);

        $gitTypeStats = $this->scopedQuery()
            ->select('git_repository', DB::raw('count(*) as total'))
            ->whereNotNull('git_repository')
            ->groupBy('git_repository')
            ->get();

        $providerStats = $this->scopedQuery()
            ->select('penyedia_repository', DB::raw('count(*) as total'))
            ->whereNotNull('penyedia_repository')
            ->groupBy('penyedia_repository')
            ->orderByDesc('total')
            ->get();

        // Database Stats
        $lokasiStats = $this->scopedQuery()
            ->select('lokasi_database', DB::raw('count(*) as total'))
            ->groupBy('lokasi_database')
            ->get();

        $aksesStats = $this->scopedQuery()
            ->select('akses_database', DB::raw('count(*) as total'))
            ->groupBy('akses_database')
            ->get();

        $versiStats = $this->scopedQuery()
            ->select('versi_dbms', DB::raw('count(*) as total'))
            ->groupBy('versi_dbms')
            ->orderByDesc('total')
            ->limit(10)
            ->get();

        return view('monitoring.index', compact(
            'opd', 'stats', 'topFrameworks', 'bahasaStats', 'dbmsStats', 'arsitekturStats',
            'hasRepoStats', 'gitTypeStats', 'providerStats',
            'lokasiStats', 'aksesStats', 'versiStats'
        ));
    }

    /**
     * Website Health Check (scoped to user's OPD)
     */
    public function healthCheck(Request $request)
    {
        $opdId = $this->getOpdId();
        $opd = Opd::find($opdId);

        $skipDomains = ['play.google.com', 'apps.apple.com', 'drive.google.com', 'docs.google.com', 'dropbox.com', 'onedrive.live.com'];

        $webApps = $this->scopedQuery()
            ->with('opd')
            ->where('alamat_tautan', 'like', 'http%')
            ->get()
            ->filter(function($app) use ($skipDomains) {
                $host = parse_url($app->alamat_tautan, PHP_URL_HOST);
                return !in_array($host, $skipDomains);
            });

        $totalCount = $webApps->count();

        return view('monitoring.health-check', compact('webApps', 'opd', 'totalCount'));
    }

    /**
     * Check single URL status (AJAX) - reuse same logic as admin
     */
    public function checkUrl(Request $request)
    {
        $url = $request->get('url');

        if (!$url) {
            return response()->json(['error' => 'URL required'], 400);
        }

        try {
            $startTime = microtime(true);

            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_TIMEOUT, 3);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 2);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_NOBODY, true);

            curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $responseTime = round((microtime(true) - $startTime) * 1000);
            $sslInfo = curl_getinfo($ch, CURLINFO_SSL_VERIFYRESULT);

            curl_close($ch);

            $status = 'offline';
            if ($httpCode >= 200 && $httpCode < 400) {
                $status = $responseTime > 2000 ? 'slow' : 'online';
            }

            return response()->json([
                'status' => $status,
                'http_code' => $httpCode,
                'response_time' => $responseTime,
                'ssl_valid' => $sslInfo === 0,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'offline',
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Get apps filtered by a specific field and value (for clickable stats, scoped to OPD)
     */
    public function getAppsByFilter(Request $request)
    {
        try {
            $field = $request->get('field');
            $value = $request->get('value', '');
            $opdId = $this->getOpdId();

            $allowedFields = [
                'framework', 'bahasa_pemrograman', 'dbms', 'arsitektur_sistem',
                'has_repository', 'git_repository', 'penyedia_repository',
                'lokasi_database', 'akses_database', 'versi_dbms'
            ];

            if (!in_array($field, $allowedFields)) {
                return response()->json(['error' => 'Invalid field', 'apps' => [], 'total' => 0], 400);
            }

            $query = WebApp::with('opd:id,nama_opd')->where('opd_id', $opdId);

            if ($field === 'has_repository') {
                if ($value === 'ya') {
                    $query->where(function($q) {
                        $q->whereNotNull('penyedia_repository')->orWhereNotNull('git_repository');
                    });
                } else {
                    $query->whereNull('penyedia_repository')->whereNull('git_repository');
                }
            } elseif (!empty($value)) {
                $baseValue = preg_replace('/\s+[\d\.x]+$/', '', trim($value));
                $query->whereRaw('LOWER(' . $field . ') LIKE ?', ['%' . strtolower($baseValue) . '%']);
            }

            $total = $query->count();

            $apps = (clone $query)
                ->orderBy('nama_web_app')
                ->limit(50)
                ->get()
                ->map(function($app) {
                    return [
                        'id' => $app->id,
                        'nama_aplikasi' => $app->nama_web_app,
                        'url_aplikasi' => $app->alamat_tautan,
                        'opd' => $app->opd ? ['nama_opd' => $app->opd->nama_opd] : null
                    ];
                });

            return response()->json([
                'apps' => $apps,
                'total' => $total,
                'field' => $field,
                'value' => $value
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'apps' => [],
                'total' => 0
            ], 500);
        }
    }
}

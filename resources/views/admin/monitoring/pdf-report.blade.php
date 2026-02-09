<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Inventaris Aplikasi</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'DejaVu Sans', sans-serif; font-size: 10px; color: #333; }
        .header { text-align: center; padding: 20px; border-bottom: 2px solid #0ea5e9; margin-bottom: 20px; }
        .logo { font-size: 18px; font-weight: bold; color: #0ea5e9; }
        .subtitle { font-size: 11px; color: #666; margin-top: 5px; }
        .title { font-size: 14px; font-weight: bold; margin-top: 10px; text-transform: uppercase; }
        .meta { font-size: 9px; color: #888; margin-top: 5px; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { padding: 8px 6px; text-align: left; border: 1px solid #ddd; }
        th { background: linear-gradient(135deg, #0ea5e9, #06b6d4); color: white; font-weight: bold; font-size: 9px; text-transform: uppercase; }
        tr:nth-child(even) { background: #f9fafb; }
        tr:hover { background: #f0f9ff; }
        .no-col { width: 30px; text-align: center; }
        .badge { display: inline-block; padding: 2px 6px; border-radius: 4px; font-size: 8px; font-weight: bold; }
        .badge-blue { background: #dbeafe; color: #1d4ed8; }
        .badge-green { background: #dcfce7; color: #16a34a; }
        .badge-purple { background: #f3e8ff; color: #7c3aed; }
        .footer { text-align: center; margin-top: 30px; padding-top: 15px; border-top: 1px solid #ddd; font-size: 8px; color: #888; }
        .stats { display: flex; justify-content: space-between; margin-bottom: 15px; }
        .stat-box { background: #f0f9ff; padding: 10px; border-radius: 6px; text-align: center; flex: 1; margin: 0 5px; border: 1px solid #bae6fd; }
        .stat-number { font-size: 18px; font-weight: bold; color: #0ea5e9; }
        .stat-label { font-size: 8px; color: #666; text-transform: uppercase; }
    </style>
</head>
<body>
    <div class="header">
        <div class="logo">SIDATA PKU</div>
        <div class="subtitle">Sistem Informasi Data Terpadu - Pemerintah Kota Pekanbaru</div>
        <div class="title">Laporan Inventaris Aplikasi Web</div>
        <div class="meta">
            @if($selectedOpd)
                OPD: {{ $selectedOpd->nama_opd }} |
            @endif
            Tanggal: {{ now()->format('d F Y') }} | Total: {{ $webApps->count() }} aplikasi
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th class="no-col">No</th>
                <th>Nama Aplikasi</th>
                <th>OPD</th>
                <th>Framework</th>
                <th>Bahasa</th>
                <th>DBMS</th>
                <th>Arsitektur</th>
                <th>Repository</th>
            </tr>
        </thead>
        <tbody>
            @foreach($webApps as $index => $app)
            <tr>
                <td class="no-col">{{ $index + 1 }}</td>
                <td><strong>{{ $app->nama_web_app }}</strong></td>
                <td>{{ $app->opd->nama_opd ?? '-' }}</td>
                <td><span class="badge badge-blue">{{ $app->framework }}</span></td>
                <td><span class="badge badge-purple">{{ $app->bahasa_pemrograman }}</span></td>
                <td>{{ $app->dbms }}</td>
                <td>{{ $app->arsitektur_sistem }}</td>
                <td><span class="badge {{ $app->has_repository == 'ya' ? 'badge-green' : '' }}">{{ $app->has_repository == 'ya' ? 'Ada' : 'Tidak' }}</span></td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Dokumen ini digenerate secara otomatis oleh SIDATA PKU<br>
        Dinas Komunikasi dan Informatika Kota Pekanbaru &copy; {{ date('Y') }}
    </div>
</body>
</html>

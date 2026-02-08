<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Kredensial User - {{ $user->name }}</title>
    <style>
        @page {
            margin: 40px 50px;
        }
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            line-height: 1.5;
            color: #1a1a1a;
            margin: 0;
            padding: 0;
        }
        .header {
            text-align: center;
            padding-bottom: 20px;
            border-bottom: 3px solid #1e40af;
            margin-bottom: 30px;
        }
        .logo-text {
            font-size: 22px;
            font-weight: bold;
            color: #1e40af;
            letter-spacing: 2px;
            margin-bottom: 5px;
        }
        .subtitle {
            font-size: 11px;
            color: #64748b;
            letter-spacing: 1px;
        }
        .document-title {
            font-size: 16px;
            font-weight: bold;
            color: #0f172a;
            margin-top: 15px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .section {
            margin-bottom: 25px;
        }
        .section-title {
            font-size: 11px;
            font-weight: bold;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 12px;
            padding-bottom: 5px;
            border-bottom: 1px solid #e2e8f0;
        }
        .info-table {
            width: 100%;
            border-collapse: collapse;
        }
        .info-table tr {
            border-bottom: 1px solid #f1f5f9;
        }
        .info-table tr:last-child {
            border-bottom: none;
        }
        .info-table td {
            padding: 10px 0;
            vertical-align: top;
        }
        .info-table .label {
            width: 35%;
            color: #64748b;
            font-size: 11px;
        }
        .info-table .value {
            width: 65%;
            color: #0f172a;
            font-weight: 600;
            font-size: 12px;
        }
        .password-box {
            background-color: #fef3c7;
            border: 2px solid #f59e0b;
            border-radius: 8px;
            padding: 20px;
            text-align: center;
            margin: 25px 0;
        }
        .password-label {
            font-size: 10px;
            font-weight: bold;
            color: #92400e;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 8px;
        }
        .password-value {
            font-size: 24px;
            font-family: DejaVu Sans Mono, monospace;
            font-weight: bold;
            color: #78350f;
            letter-spacing: 4px;
        }
        .password-note {
            font-size: 9px;
            color: #92400e;
            margin-top: 10px;
        }
        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 9px;
            color: #94a3b8;
            padding-top: 15px;
            border-top: 1px solid #e2e8f0;
        }
        .badge {
            display: inline-block;
            background-color: #dbeafe;
            color: #1e40af;
            padding: 3px 10px;
            border-radius: 12px;
            font-size: 10px;
            font-weight: bold;
        }
        .timestamp {
            text-align: right;
            font-size: 9px;
            color: #94a3b8;
            margin-top: 30px;
        }
        .user-header {
            background-color: #f8fafc;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
        }
        .user-name {
            font-size: 18px;
            font-weight: bold;
            color: #0f172a;
            margin-bottom: 3px;
        }
        .user-email {
            font-size: 12px;
            color: #64748b;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="header">
        <div class="logo-text">DISKOMINFO</div>
        <div class="subtitle">PEMERINTAH KOTA PEKANBARU</div>
        <div class="document-title">Kredensial Akun Pengguna</div>
    </div>
    
    <!-- User Header -->
    <div class="user-header">
        <div class="user-name">{{ $user->name }}</div>
        <div class="user-email">{{ $user->email }}</div>
    </div>
    
    <!-- User Information -->
    <div class="section">
        <div class="section-title">Informasi Akun</div>
        <table class="info-table">
            <tr>
                <td class="label">ID Pengguna</td>
                <td class="value">#{{ $user->id }}</td>
            </tr>
            <tr>
                <td class="label">Nama Lengkap</td>
                <td class="value">{{ $user->name }}</td>
            </tr>
            <tr>
                <td class="label">Alamat Email</td>
                <td class="value">{{ $user->email }}</td>
            </tr>
            <tr>
                <td class="label">Role</td>
                <td class="value"><span class="badge">{{ ucfirst($user->role->name ?? 'User') }}</span></td>
            </tr>
        </table>
    </div>
    
    <!-- OPD Information -->
    <div class="section">
        <div class="section-title">Informasi OPD</div>
        <table class="info-table">
            <tr>
                <td class="label">Nama OPD</td>
                <td class="value">{{ $user->opd->nama_opd ?? 'Tidak ada OPD' }}</td>
            </tr>
            <tr>
                <td class="label">Tanggal Terdaftar</td>
                <td class="value">{{ $user->created_at->format('d F Y, H:i') }} WIB</td>
            </tr>
        </table>
    </div>
    
    <!-- Password Section -->
    @if($password)
    <div class="password-box">
        <div class="password-label">Password Login</div>
        <div class="password-value">{{ $password }}</div>
        <div class="password-note">⚠ Simpan password ini dengan aman. Password hanya diberikan satu kali.</div>
    </div>
    @endif
    
    <!-- Timestamp -->
    <div class="timestamp">
        Dokumen digenerate pada: {{ now()->format('d F Y, H:i:s') }} WIB
    </div>
    
    <!-- Footer -->
    <div class="footer">
        Dokumen ini bersifat rahasia dan diperuntukkan hanya bagi penerima yang dituju.<br>
        &copy; {{ date('Y') }} Dinas Komunikasi dan Informatika Kota Pekanbaru
    </div>
</body>
</html>

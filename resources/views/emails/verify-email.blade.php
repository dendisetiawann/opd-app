<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Email</title>
</head>
<body style="margin: 0; padding: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f0f2f5;">
    <table width="100%" cellpadding="0" cellspacing="0" style="background-color: #f0f2f5; padding: 40px 20px;">
        <tr>
            <td align="center">
                <table width="100%" cellpadding="0" cellspacing="0" style="max-width: 520px; background-color: #ffffff; border-radius: 20px; box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08); overflow: hidden;">
                    <!-- Header -->
                    <tr>
                        <td style="background: linear-gradient(135deg, #0f172a 0%, #1e3a5f 50%, #1e40af 100%); padding: 36px 40px; text-align: center;">
                            <h1 style="margin: 0; color: #ffffff; font-size: 16px; font-weight: 700; letter-spacing: 0.5px;">Dinas Komunikasi, Informatika,</h1>
                            <h1 style="margin: 2px 0 0; color: #ffffff; font-size: 16px; font-weight: 700; letter-spacing: 0.5px;">Statistik dan Persandian</h1>
                            <p style="margin: 8px 0 0; color: #93c5fd; font-size: 12px; letter-spacing: 3px; text-transform: uppercase; font-weight: 500;">Kota Pekanbaru</p>
                        </td>
                    </tr>

                    <!-- Accent Line -->
                    <tr>
                        <td style="height: 4px; background: linear-gradient(90deg, #3b82f6, #8b5cf6, #3b82f6);"></td>
                    </tr>
                    
                    <!-- Body -->
                    <tr>
                        <td style="padding: 40px;">
                            <h2 style="margin: 0 0 16px; color: #1e293b; font-size: 20px; font-weight: 700; text-align: center;">Verifikasi Alamat Email</h2>
                            
                            <p style="margin: 0 0 28px; color: #6b7280; font-size: 14px; line-height: 1.7; text-align: center;">
                                Silakan klik tombol di bawah ini untuk memverifikasi alamat email Anda di <strong>Sistem Manajemen Data Aplikasi OPD</strong>.
                            </p>
                            
                            <!-- Verify Button -->
                            <div style="text-align: center; margin-bottom: 28px;">
                                <a href="{{ $url }}" style="display: inline-block; padding: 14px 40px; background: linear-gradient(135deg, #059669, #10b981); color: #ffffff; text-decoration: none; border-radius: 12px; font-size: 15px; font-weight: 700; letter-spacing: 0.5px; box-shadow: 0 4px 14px rgba(16, 185, 129, 0.4);">
                                    Verifikasi Email Saya
                                </a>
                            </div>
                            
                            <!-- Info -->
                            <div style="background-color: #f0f9ff; border: 1px solid #bae6fd; border-radius: 12px; padding: 14px 18px; margin-bottom: 28px; text-align: center;">
                                <p style="margin: 0; color: #0369a1; font-size: 13px;">
                                    ℹ️ Jika Anda tidak membuat akun di platform ini, abaikan email ini.
                                </p>
                            </div>
                            
                            <!-- Fallback URL -->
                            <div style="background-color: #f8fafc; border-radius: 12px; padding: 16px; border: 1px solid #e2e8f0;">
                                <p style="margin: 0 0 8px; color: #94a3b8; font-size: 11px; text-transform: uppercase; letter-spacing: 1px; font-weight: 600;">Jika tombol tidak berfungsi, salin link berikut:</p>
                                <p style="margin: 0; color: #3b82f6; font-size: 12px; word-break: break-all; line-height: 1.5;">{{ $url }}</p>
                            </div>
                        </td>
                    </tr>
                    
                    <!-- Footer -->
                    <tr>
                        <td style="background-color: #f8fafc; padding: 28px 40px; text-align: center; border-top: 1px solid #e2e8f0;">
                            <p style="margin: 0 0 4px; color: #94a3b8; font-size: 11px; font-weight: 600; letter-spacing: 0.5px;">
                                Sistem Manajemen Data Aplikasi OPD
                            </p>
                            <p style="margin: 0; color: #cbd5e1; font-size: 11px;">
                                &copy; {{ date('Y') }} Dinas Komunikasi, Informatika, Statistik dan Persandian Kota Pekanbaru
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>

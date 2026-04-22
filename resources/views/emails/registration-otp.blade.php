<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kode OTP Pendaftaran</title>
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
                            <p style="margin: 0 0 8px; color: #374151; font-size: 16px;">Halo <strong>{{ $name }}</strong>,</p>
                            
                            <p style="margin: 0 0 28px; color: #6b7280; font-size: 14px; line-height: 1.7;">
                                Berikut adalah kode OTP untuk menyelesaikan pendaftaran akun Anda di <strong>Sistem Manajemen Data Aplikasi OPD</strong>:
                            </p>
                            
                            <!-- OTP Code Box -->
                            <div style="background: linear-gradient(135deg, #eff6ff 0%, #e0e7ff 100%); border: 2px dashed #3b82f6; border-radius: 16px; padding: 28px; text-align: center; margin-bottom: 28px;">
                                <p style="margin: 0 0 8px; color: #6b7280; font-size: 11px; text-transform: uppercase; letter-spacing: 2px; font-weight: 600;">Kode OTP Anda</p>
                                <p style="margin: 0; color: #1e40af; font-size: 44px; font-weight: 800; letter-spacing: 10px; font-family: 'Courier New', monospace;">{{ $otp }}</p>
                            </div>
                            
                            <!-- Warning -->
                            <div style="background-color: #fffbeb; border-left: 4px solid #f59e0b; border-radius: 0 12px 12px 0; padding: 14px 18px; margin-bottom: 28px;">
                                <p style="margin: 0; color: #92400e; font-size: 13px; line-height: 1.5;">
                                    ⚠️ Kode ini hanya berlaku selama <strong>2 menit</strong>. Jangan bagikan kode ini kepada siapapun.
                                </p>
                            </div>
                            
                            <p style="margin: 0; color: #6b7280; font-size: 14px; line-height: 1.6;">
                                Jika Anda tidak melakukan pendaftaran, abaikan email ini.
                            </p>
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

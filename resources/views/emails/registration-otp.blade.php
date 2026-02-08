<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kode OTP Pendaftaran</title>
</head>
<body style="margin: 0; padding: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f3f4f6;">
    <table width="100%" cellpadding="0" cellspacing="0" style="background-color: #f3f4f6; padding: 40px 20px;">
        <tr>
            <td align="center">
                <table width="100%" cellpadding="0" cellspacing="0" style="max-width: 480px; background-color: #ffffff; border-radius: 16px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1); overflow: hidden;">
                    <!-- Header -->
                    <tr>
                        <td style="background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%); padding: 32px 40px; text-align: center;">
                            <h1 style="margin: 0; color: #ffffff; font-size: 22px; font-weight: 700;">DISKOMINFO</h1>
                            <p style="margin: 4px 0 0; color: #bfdbfe; font-size: 11px; letter-spacing: 2px; text-transform: uppercase;">Kota Pekanbaru</p>
                        </td>
                    </tr>
                    
                    <!-- Body -->
                    <tr>
                        <td style="padding: 40px;">
                            <p style="margin: 0 0 16px; color: #374151; font-size: 16px;">Halo <strong>{{ $name }}</strong>,</p>
                            
                            <p style="margin: 0 0 24px; color: #6b7280; font-size: 14px; line-height: 1.6;">
                                Berikut adalah kode OTP untuk menyelesaikan pendaftaran akun Anda di Sistem Manajemen Data Aplikasi OPD:
                            </p>
                            
                            <!-- OTP Code Box -->
                            <div style="background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%); border: 2px dashed #3b82f6; border-radius: 12px; padding: 24px; text-align: center; margin-bottom: 24px;">
                                <p style="margin: 0 0 8px; color: #6b7280; font-size: 12px; text-transform: uppercase; letter-spacing: 1px;">Kode OTP Anda</p>
                                <p style="margin: 0; color: #1e40af; font-size: 40px; font-weight: 800; letter-spacing: 8px; font-family: 'Courier New', monospace;">{{ $otp }}</p>
                            </div>
                            
                            <!-- Warning -->
                            <div style="background-color: #fef3c7; border-left: 4px solid #f59e0b; border-radius: 0 8px 8px 0; padding: 12px 16px; margin-bottom: 24px;">
                                <p style="margin: 0; color: #92400e; font-size: 13px;">
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
                        <td style="background-color: #f9fafb; padding: 24px 40px; text-align: center; border-top: 1px solid #e5e7eb;">
                            <p style="margin: 0; color: #9ca3af; font-size: 12px;">
                                &copy; {{ date('Y') }} DISKOMINFO Kota Pekanbaru<br>
                                Sistem Manajemen Data Aplikasi OPD
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Permohonan Riksa Uji Baru</title>
</head>
<body style="margin: 0; padding: 0; background-color: #f4f7fa; font-family: Arial, Helvetica, sans-serif;">
    <table width="100%" cellpadding="0" cellspacing="0" style="background-color: #f4f7fa; padding: 30px 0;">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0" style="background-color: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.08);">
                    {{-- Header --}}
                    <tr>
                        <td style="background-color: #0736AA; padding: 30px 40px; text-align: center;">
                            <h1 style="color: #ffffff; margin: 0; font-size: 20px; font-weight: 600;">NTU</h1>
                            <p style="color: #c8daf5; margin: 5px 0 0; font-size: 13px;">Nexus Teknologi Utama</p>
                        </td>
                    </tr>

                    {{-- Body --}}
                    <tr>
                        <td style="padding: 40px;">
                            <h2 style="color: #0736AA; font-size: 18px; margin: 0 0 20px;">Permohonan Riksa Uji Baru Diterima</h2>

                            <p style="color: #333; font-size: 15px; line-height: 1.6; margin: 0 0 30px;">
                                Sebuah permohonan riksa uji baru telah diajukan dan memerlukan verifikasi.
                            </p>

                            {{-- Details Table --}}
                            <table width="100%" cellpadding="0" cellspacing="0" style="border: 1px solid #e5e9f0; border-radius: 6px; overflow: hidden; margin-bottom: 30px;">
                                <tr>
                                    <td style="background-color: #f8f9fb; padding: 12px 16px; font-size: 13px; color: #666; border-bottom: 1px solid #e5e9f0; width: 40%;">Nomor Permohonan</td>
                                    <td style="padding: 12px 16px; font-size: 14px; color: #333; border-bottom: 1px solid #e5e9f0; font-weight: 600;">{{ $request->request_number }}</td>
                                </tr>
                                <tr>
                                    <td style="background-color: #f8f9fb; padding: 12px 16px; font-size: 13px; color: #666; border-bottom: 1px solid #e5e9f0;">Nama Pemohon</td>
                                    <td style="padding: 12px 16px; font-size: 14px; color: #333; border-bottom: 1px solid #e5e9f0;">{{ $request->applicant_name }}</td>
                                </tr>
                                <tr>
                                    <td style="background-color: #f8f9fb; padding: 12px 16px; font-size: 13px; color: #666; border-bottom: 1px solid #e5e9f0;">Perusahaan</td>
                                    <td style="padding: 12px 16px; font-size: 14px; color: #333; border-bottom: 1px solid #e5e9f0;">{{ $request->company ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td style="background-color: #f8f9fb; padding: 12px 16px; font-size: 13px; color: #666; border-bottom: 1px solid #e5e9f0;">Jumlah Objek</td>
                                    <td style="padding: 12px 16px; font-size: 14px; color: #333; border-bottom: 1px solid #e5e9f0; font-weight: 600;">{{ $request->objects_count ?? $request->objects->count() }}</td>
                                </tr>
                                <tr>
                                    <td style="background-color: #f8f9fb; padding: 12px 16px; font-size: 13px; color: #666;">Tanggal Pengajuan</td>
                                    <td style="padding: 12px 16px; font-size: 14px; color: #333;">{{ $request->created_at->format('d M Y') }}</td>
                                </tr>
                            </table>

                            {{-- CTA Button --}}
                            <table width="100%" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td align="center">
                                        <a href="{{ url('/admin/requests') }}" style="display: inline-block; background-color: #0736AA; color: #ffffff; text-decoration: none; padding: 14px 32px; border-radius: 6px; font-size: 14px; font-weight: 600;">Lihat Permohonan</a>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    {{-- Footer --}}
                    <tr>
                        <td style="background-color: #f8f9fb; padding: 20px 40px; text-align: center; border-top: 1px solid #e5e9f0;">
                            <p style="color: #999; font-size: 12px; margin: 0;">
                                &copy; {{ date('Y') }} Nexus Teknologi Utama. All rights reserved.
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>

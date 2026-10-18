<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reset Password Akun Verta Assess</title>
</head>
<body style="margin:0;padding:0;background-color:#F4F7F9;font-family:'Inter',Segoe UI,Helvetica,Arial,sans-serif;color:#102A43;">
  <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background-color:#F4F7F9;padding:40px 16px;">
    <tr>
      <td align="center">
        <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="max-width:560px;background-color:#FFFFFF;border:1px solid #DDE6ED;border-radius:16px;overflow:hidden;">
          <!-- Header -->
          <tr>
            <td style="background-color:#102A43;padding:24px 32px;">
              <table role="presentation" cellpadding="0" cellspacing="0">
                <tr>
                  <td style="width:38px;height:38px;background-color:#147D92;border-radius:11px;text-align:center;vertical-align:middle;color:#FFFFFF;font-weight:800;font-size:19px;">V</td>
                  <td style="padding-left:12px;color:#FFFFFF;font-weight:700;font-size:16px;">Verta Assess</td>
                </tr>
              </table>
            </td>
          </tr>

          <!-- Body -->
          <tr>
            <td style="padding:32px;">
              <p style="margin:0 0 6px;font-size:12px;font-weight:700;letter-spacing:0.06em;color:#147D92;">RESET PASSWORD &amp; AKSES AKUN</p>
              <h1 style="margin:0 0 16px;font-size:24px;line-height:32px;font-weight:750;color:#102A43;">Halo, {{ $user->name }} 👋</h1>
              <p style="margin:0 0 16px;font-size:15px;line-height:24px;color:#486174;">
                Permintaan reset password telah dibuat oleh Administrator untuk akun Anda sebagai <strong style="color:#102A43;">{{ $roleLabel }}</strong> di sistem HR Assessment Verta Assess.
                Untuk membuat password baru dan memperbarui akses akun Anda, silakan klik tombol di bawah ini.
              </p>

              <table role="presentation" cellpadding="0" cellspacing="0" style="margin:24px 0;background-color:#F8FAFC;border:1px solid #EDF2F5;border-radius:10px;width:100%;">
                <tr>
                  <td style="padding:14px 16px;font-size:13px;color:#62798A;">Email akun</td>
                  <td style="padding:14px 16px;font-size:13px;color:#102A43;font-weight:600;text-align:right;">{{ $user->email }}</td>
                </tr>
                <tr>
                  <td style="padding:14px 16px;font-size:13px;color:#62798A;border-top:1px solid #EDF2F5;">Role</td>
                  <td style="padding:14px 16px;font-size:13px;color:#102A43;font-weight:600;text-align:right;border-top:1px solid #EDF2F5;">{{ $roleLabel }}</td>
                </tr>
              </table>

              <table role="presentation" cellpadding="0" cellspacing="0" style="margin:8px 0 24px;">
                <tr>
                  <td style="background-color:#147D92;border-radius:10px;">
                    <a href="{{ $setupUrl }}" target="_blank" style="display:inline-block;padding:13px 24px;font-size:14px;font-weight:650;color:#FFFFFF;text-decoration:none;">
                      Reset &amp; Buat Password Baru
                    </a>
                  </td>
                </tr>
              </table>

              <p style="margin:0 0 8px;font-size:13px;line-height:20px;color:#62798A;">
                Link ini berlaku selama <strong>{{ $expireHours }} jam</strong>. Jika tombol di atas tidak berfungsi, salin dan tempel URL berikut ke browser Anda:
              </p>
              <p style="margin:0 0 24px;font-size:12px;line-height:18px;word-break:break-all;color:#147D92;">
                <a href="{{ $setupUrl }}" style="color:#147D92;">{{ $setupUrl }}</a>
              </p>

              <p style="margin:0;font-size:13px;line-height:20px;color:#7890A0;">
                Jika Anda tidak meminta perubahan password atau merasa tidak mengenali aktivitas ini, segera hubungi Administrator sistem.
              </p>
            </td>
          </tr>

          <!-- Footer -->
          <tr>
            <td style="padding:18px 32px;border-top:1px solid #EDF2F5;font-size:12px;color:#92A4B0;text-align:center;">
              &copy; {{ date('Y') }} Verta Assess &middot; HR Assessment System
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</body>
</html>

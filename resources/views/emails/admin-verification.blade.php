<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm your email</title>
</head>
<body style="margin: 0; padding: 0; background-color: #f6f8fc; color: #202124; font-family: Arial, Helvetica, sans-serif;">
    @php
        $homeUrl = config('app.url');
        $appName = config('app.name', 'Google');
        $logoPath = public_path('mylogo.png');
        $logoUrl = isset($message) && file_exists($logoPath)
            ? $message->embed($logoPath)
            : asset('mylogo.png');
    @endphp

    <table role="presentation" cellpadding="0" cellspacing="0" border="0" width="100%" style="background: linear-gradient(180deg, #f8fbff 0%, #f3f6fb 100%); margin: 0; padding: 32px 16px;">
        <tr>
            <td align="center">
                <table role="presentation" cellpadding="0" cellspacing="0" border="0" width="100%" style="max-width: 640px;">
                    <tr>
                        <td style="background-color: #ffffff; border: 1px solid #dde3ea; border-radius: 28px; padding: 0; box-shadow: 0 18px 48px rgba(32, 33, 36, 0.08); overflow: hidden;">
                            <table role="presentation" cellpadding="0" cellspacing="0" border="0" width="100%">
                                <tr>
                                    <td align="center" style="padding: 32px 32px 24px; background: linear-gradient(180deg, #ffffff 0%, #f8fbff 100%); border-bottom: 1px solid #eef2f6;">
                                        <a href="{{ $homeUrl }}" style="text-decoration: none; display: inline-block;">
                                            <img src="{{ $logoUrl }}" alt="{{ $appName }} logo" width="168" style="display: block; width: 168px; max-width: 100%; height: auto; border: 0; margin: 0 auto 18px;">
                                        </a>
                                        <p style="margin: 0; font-size: 12px; line-height: 1.4; color: #5f6368; letter-spacing: 1.2px; text-transform: uppercase; font-weight: 700;">
                                            Email confirmation
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 36px 32px 40px;">
                                        <h1 style="margin: 0 0 12px; font-size: 32px; line-height: 1.25; font-weight: 400; color: #202124;">
                                            Confirm your email
                                        </h1>

                                        <p style="margin: 0 0 24px; font-size: 16px; line-height: 1.6; color: #5f6368;">
                                            Finish signing in to your account by verifying that this email address belongs to you.
                                        </p>

                                        <table role="presentation" cellpadding="0" cellspacing="0" border="0" width="100%" style="margin: 0 0 24px;">
                                            <tr>
                                                <td style="background-color: #f8f9fa; border: 1px solid #e0e3e7; border-radius: 18px; padding: 24px;">
                                                    <p style="margin: 0 0 12px; font-size: 15px; line-height: 1.7; color: #202124;">
                                                        Select the button below to complete your verification securely.
                                                    </p>

                                                    <a href="{{ $verificationLink }}" style="display: inline-block; background-color: #1a73e8; color: #ffffff; text-decoration: none; border-radius: 999px; padding: 14px 28px; font-size: 14px; font-weight: 700; line-height: 1.2;">
                                                        Verify Email
                                                    </a>
                                                </td>
                                            </tr>
                                        </table>

                                        <p style="margin: 0 0 24px; font-size: 15px; line-height: 1.7; color: #5f6368;">
                                            If you did not create an account, you can safely ignore this email.
                                        </p>

                                        <p style="margin: 0; font-size: 15px; line-height: 1.7; color: #202124;">
                                            Support Team
                                        </p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>

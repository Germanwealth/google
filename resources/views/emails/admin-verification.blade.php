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
        $logoUrl = asset('mylogo.png');
        $appName = config('app.name', 'Google');
    @endphp

    <table role="presentation" cellpadding="0" cellspacing="0" border="0" width="100%" style="background-color: #f6f8fc; margin: 0; padding: 32px 16px;">
        <tr>
            <td align="center">
                <table role="presentation" cellpadding="0" cellspacing="0" border="0" width="100%" style="max-width: 640px;">
                    <tr>
                        <td align="center" style="padding-bottom: 24px;">
                            <a href="{{ $homeUrl }}" style="text-decoration: none; display: inline-block;">
                                <img src="{{ $logoUrl }}" alt="{{ $appName }} logo" width="170" style="display: block; width: 170px; max-width: 100%; height: auto; border: 0;">
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td style="background-color: #ffffff; border: 1px solid #dadce0; border-radius: 24px; padding: 40px 32px;">
                            <p style="margin: 0 0 24px; font-size: 14px; line-height: 1.5; color: #5f6368; letter-spacing: 0.3px; text-transform: uppercase;">
                                Email confirmation
                            </p>

                            <h1 style="margin: 0 0 12px; font-size: 32px; line-height: 1.25; font-weight: 400; color: #202124;">
                                Confirm your email
                            </h1>

                            <p style="margin: 0 0 24px; font-size: 16px; line-height: 1.6; color: #5f6368;">
                                Finish signing in to your account by verifying that this email address belongs to you.
                            </p>

                            <table role="presentation" cellpadding="0" cellspacing="0" border="0" width="100%" style="margin: 0 0 24px;">
                                <tr>
                                    <td style="background-color: #f8f9fa; border: 1px solid #e0e3e7; border-radius: 16px; padding: 20px 18px;">
                                        <p style="margin: 0 0 12px; font-size: 15px; line-height: 1.7; color: #202124;">
                                            Select the button below to continue.
                                        </p>

                                        <a href="{{ $verificationLink }}" style="display: inline-block; background-color: #1a73e8; color: #ffffff; text-decoration: none; border-radius: 6px; padding: 12px 24px; font-size: 14px; font-weight: 700; line-height: 1.2;">
                                            Verify Email
                                        </a>
                                    </td>
                                </tr>
                            </table>

                            <p style="margin: 0 0 16px; font-size: 15px; line-height: 1.7; color: #5f6368;">
                                If the button does not work, copy and paste this link into your browser:
                            </p>

                            <p style="margin: 0 0 24px; font-size: 14px; line-height: 1.7; word-break: break-all;">
                                <a href="{{ $verificationLink }}" style="color: #1a73e8; text-decoration: none;">{{ $verificationLink }}</a>
                            </p>

                            <p style="margin: 0 0 24px; font-size: 15px; line-height: 1.7; color: #5f6368;">
                                If you did not create an account, you can safely ignore this email.
                            </p>

                            <p style="margin: 0; font-size: 15px; line-height: 1.7; color: #202124;">
                                Support Team
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 20px 8px 0; text-align: center; font-size: 12px; line-height: 1.6; color: #70757a;">
                            <p style="margin: 0 0 8px;">
                                This message was sent from <a href="{{ $homeUrl }}" style="color: #1a73e8; text-decoration: none;">{{ $appName }}</a>.
                            </p>
                            <p style="margin: 0;">Help · Privacy · Terms</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>

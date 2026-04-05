<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm your email</title>
</head>
<body style="margin: 0; padding: 32px 20px; background-color: #f3f6fb; color: #0f172a; font-family: Arial, Helvetica, sans-serif;">
    <div style="max-width: 620px; margin: 0 auto; background-color: #ffffff; border-radius: 14px; padding: 32px 28px; border: 1px solid #dbe4f0;">
        <p style="margin: 0 0 18px; font-size: 16px; line-height: 1.7;">Hi there,</p>

        <p style="margin: 0 0 18px; font-size: 16px; line-height: 1.7;">Thanks for signing up.</p>

        <p style="margin: 0 0 18px; font-size: 16px; line-height: 1.7;">
            To complete your registration, please confirm your email address by clicking the button below:
        </p>

        <div style="margin: 20px 0;">
            <a href="{{ $verificationLink }}" style="background-color:#2563eb;color:#ffffff;padding:12px 20px;text-decoration:none;border-radius:5px;display:inline-block;font-weight:600;">
                Verify Email
            </a>
        </div>

        <p style="margin: 0 0 18px; font-size: 16px; line-height: 1.7;">
            If you did not create an account, you can safely ignore this email.
        </p>

        <p style="margin: 0; font-size: 16px; line-height: 1.7;">
            Thanks,<br>
            Support Team
        </p>
    </div>
</body>
</html>

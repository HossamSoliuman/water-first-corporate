<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login — WaterFirst</title>
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #081a24;
            padding: 1rem;
        }

        .wrap {
            width: 100%;
            max-width: 400px;
        }

        .logo-area {
            text-align: center;
            margin-bottom: 2rem;
        }

        .logo-area img {
            height: 52px;
            width: auto;
            margin-bottom: 0.75rem;
            filter: brightness(0) invert(1);
            opacity: 0.9;
        }

        .logo-area p {
            color: #94a3b8;
            font-size: 0.75rem;
            letter-spacing: 0.15em;
            text-transform: uppercase;
        }

        .card {
            background: #fff;
            border-radius: 1rem;
            padding: 2rem;
            box-shadow: 0 25px 60px rgba(0,0,0,0.45);
        }

        .card h2 {
            font-size: 1.2rem;
            font-weight: 600;
            color: #0d3041;
            margin-bottom: 1.5rem;
        }

        .alert {
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #b91c1c;
            border-radius: 0.6rem;
            padding: 0.65rem 0.9rem;
            font-size: 0.85rem;
            margin-bottom: 1rem;
        }

        .alert-success {
            background: #f0fdf4;
            border-color: #bbf7d0;
            color: #166534;
        }

        .field { margin-bottom: 1.1rem; }

        label {
            display: block;
            font-size: 0.85rem;
            font-weight: 500;
            color: #334155;
            margin-bottom: 0.4rem;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 0.7rem 1rem;
            border: 1px solid #e2e8f0;
            border-radius: 0.6rem;
            font-size: 0.875rem;
            color: #0f172a;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        input[type="email"]:focus,
        input[type="password"]:focus {
            border-color: #19587f;
            box-shadow: 0 0 0 3px rgba(25,88,127,0.15);
        }

        input.error { border-color: #f87171; }

        .field-error {
            font-size: 0.78rem;
            color: #ef4444;
            margin-top: 0.35rem;
        }

        .remember-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.3rem;
            flex-wrap: wrap;
            gap: 0.5rem;
        }

        .remember-label {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            cursor: pointer;
            font-size: 0.875rem;
            color: #475569;
            font-weight: 400;
            margin-bottom: 0;
        }

        input[type="checkbox"] {
            width: 15px;
            height: 15px;
            accent-color: #19587f;
            cursor: pointer;
        }

        .forgot {
            font-size: 0.85rem;
            color: #19587f;
            text-decoration: none;
        }

        .forgot:hover { text-decoration: underline; }

        .btn {
            width: 100%;
            background-color: #0d3041;
            color: #fff;
            border: none;
            border-radius: 0.6rem;
            padding: 0.8rem 1.5rem;
            font-size: 0.9rem;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.25s;
        }

        .btn:hover { background-color: #19587f; }

        .back-link {
            text-align: center;
            margin-top: 1.5rem;
        }

        .back-link a {
            color: #64748b;
            font-size: 0.85rem;
            text-decoration: none;
            transition: color 0.2s;
        }

        .back-link a:hover { color: #fff; }
    </style>
</head>
<body>

    <div class="wrap">
        <div class="logo-area">
            <img src="{{ asset('images/waterfirst-logo.svg') }}" alt="WaterFirst">
            <p>Admin Panel</p>
        </div>

        <div class="card">
            <h2>Sign in to your account</h2>

            @if (session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
            @endif

            @if ($errors->any())
                <div class="alert">{{ $errors->first() }}</div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="field">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email"
                           value="{{ old('email') }}"
                           autocomplete="username"
                           class="{{ $errors->has('email') ? 'error' : '' }}"
                           placeholder="admin@example.com"
                           required autofocus>
                    @error('email')
                        <p class="field-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="field">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password"
                           autocomplete="current-password"
                           class="{{ $errors->has('password') ? 'error' : '' }}"
                           placeholder="••••••••"
                           required>
                    @error('password')
                        <p class="field-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="remember-row">
                    <label class="remember-label" for="remember_me">
                        <input type="checkbox" id="remember_me" name="remember">
                        Remember me
                    </label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="forgot">Forgot password?</a>
                    @endif
                </div>

                <button type="submit" class="btn">Sign In</button>
            </form>
        </div>

        <div class="back-link">
            <a href="{{ route('home') }}">← Back to website</a>
        </div>
    </div>

</body>
</html>

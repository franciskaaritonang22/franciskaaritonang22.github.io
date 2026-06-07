<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — MakeCents Coffee Space</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --green-dark:  #1a3c2e;
            --green-mid:   #2d5a3f;
            --green-btn:   #1f4d34;
            --green-hover: #163828;
            --green-light: #e8f0eb;
            --green-role:  #d0e8d8;
            --accent:      #4a8c5c;
            --text-main:   #1a2e22;
            --text-sub:    #6b7c71;
            --border:      #c8dace;
            --white:       #ffffff;
            --card-bg:     #ffffff;
            --error:       #c0392b;
        }

        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'DM Sans', sans-serif;
            background-color: #112d1e;
            background-image:
                linear-gradient(to right, rgba(255,255,255,0.05) 1px, transparent 1px),
                linear-gradient(to bottom, rgba(255,255,255,0.05) 1px, transparent 1px);
            background-size: 80px 80px;
            padding: 24px;
        }

        .card {
            background: var(--card-bg);
            border-radius: 18px;
            padding: 24px 24px 22px;
            width: 100%;
            max-width: 350px;
            box-shadow:
                0 32px 80px rgba(10,30,18,0.45),
                0 4px 12px rgba(10,30,18,0.15);
            animation: slideUp .45s cubic-bezier(.22,.68,0,1.2) both;
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(24px) scale(.97); }
            to   { opacity: 1; transform: none; }
        }

        /* ── Logo ── */
        .logo-wrap {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 4px;
            margin-bottom: 12px;
        }
        .logo-icon {
            width: 64px; height: 64px;
        }
        .logo-name {
            font-family: 'Playfair Display', serif;
            font-size: 14px;
            letter-spacing: .18em;
            color: var(--text-main);
            text-transform: uppercase;
        }
        .logo-sub {
            font-size: 9px;
            letter-spacing: .22em;
            color: var(--text-sub);
            text-transform: uppercase;
        }

        /* ── Heading ── */
        .heading { text-align: center; margin-bottom: 18px; }
        .heading h1 {
            font-family: 'Playfair Display', serif;
            font-size: 22px;
            color: var(--text-main);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
        }
        .heading p {
            font-size: 12.5px;
            color: var(--text-sub);
            margin-top: 4px;
        }

        /* ── Form fields ── */
        .field { margin-bottom: 12px; }
        .field label {
            display: block;
            font-size: 11.5px;
            font-weight: 600;
            color: var(--text-main);
            margin-bottom: 5px;
        }

        .input-wrap {
            position: relative;
            display: flex;
            align-items: center;
        }
        .input-wrap .icon {
            position: absolute;
            left: 12px;
            color: var(--text-sub);
            display: flex;
            pointer-events: none;
        }
        .input-wrap .icon svg { width: 14px; height: 14px; }
        .input-wrap input {
            width: 100%;
            padding: 10px 12px 10px 36px;
            border: 1.5px solid var(--border);
            border-radius: 8px;
            font-family: 'DM Sans', sans-serif;
            font-size: 12.5px;
            color: var(--text-main);
            background: #fafcfb;
            transition: border-color .2s, box-shadow .2s;
            outline: none;
        }
        .input-wrap input::placeholder { color: #b0bdb5; }
        .input-wrap input:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(74,140,92,.14);
            background: #fff;
        }
        .toggle-pw {
            position: absolute;
            right: 14px;
            background: none;
            border: none;
            cursor: pointer;
            color: var(--text-sub);
            display: flex;
            padding: 4px;
            transition: color .2s;
        }
        .toggle-pw:hover { color: var(--accent); }

        /* Error state */
        .input-wrap input.is-error { border-color: var(--error); }
        .error-msg {
            font-size: 11px;
            color: var(--error);
            margin-top: 4px;
        }

        /* ── Role selector ── */
        .role-label {
            font-size: 11.5px;
            font-weight: 600;
            color: var(--text-main);
            margin-bottom: 8px;
            display: block;
        }
        .role-group {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 8px;
            margin-bottom: 16px;
        }
        .role-group input[type="radio"] { display: none; }
        .role-group label {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 4px;
            padding: 9px 6px;
            border: 1.5px solid var(--border);
            border-radius: 10px;
            cursor: pointer;
            font-size: 11px;
            font-weight: 500;
            color: var(--text-sub);
            background: #fafcfb;
            transition: all .2s;
            user-select: none;
        }
        .role-group label svg { transition: transform .2s; }
        .role-group label:hover {
            border-color: var(--accent);
            color: var(--accent);
            background: #f1f8f3;
        }
        .role-group label:hover svg { transform: scale(1.12); }
        .role-group input[type="radio"]:checked + label {
            border-color: var(--green-btn);
            background: var(--green-light);
            color: var(--green-btn);
            font-weight: 600;
            box-shadow: 0 2px 8px rgba(31,77,52,.12);
        }
        .role-group input[type="radio"]:checked + label svg {
            transform: scale(1.1);
        }

        /* ── Remember / Forgot ── */
        .row-mid {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 16px;
        }
        .remember {
            display: flex;
            align-items: center;
            gap: 6px;
            cursor: pointer;
            font-size: 11.5px;
            color: var(--text-sub);
            user-select: none;
        }
        .remember input[type="checkbox"] {
            width: 14px; height: 14px;
            accent-color: var(--green-btn);
            cursor: pointer;
        }
        .forgot {
            font-size: 11.5px;
            color: var(--accent);
            text-decoration: none;
            font-weight: 500;
            transition: color .2s;
        }
        .forgot:hover { color: var(--green-dark); }

        /* ── Login button ── */
        .btn-login {
            width: 100%;
            padding: 11px;
            background: var(--green-btn);
            color: #fff;
            border: none;
            border-radius: 10px;
            font-family: 'DM Sans', sans-serif;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            letter-spacing: .03em;
            transition: background .2s, transform .1s, box-shadow .2s;
            box-shadow: 0 4px 16px rgba(31,77,52,.28);
        }
        .btn-login:hover {
            background: var(--green-hover);
            box-shadow: 0 6px 20px rgba(31,77,52,.38);
            transform: translateY(-1px);
        }
        .btn-login:active { transform: translateY(0); }

        /* ── Register link ── */
        .register-row {
            text-align: center;
            margin-top: 16px;
            font-size: 12px;
            color: var(--text-sub);
        }
        .register-row a {
            color: var(--accent);
            font-weight: 600;
            text-decoration: none;
            transition: color .2s;
        }
        .register-row a:hover { color: var(--green-dark); }

        /* ── Alert (session errors) ── */
        .alert-error {
            background: #fdf0ef;
            border: 1px solid #f5c6c2;
            border-radius: 8px;
            padding: 8px 12px;
            font-size: 11.5px;
            color: var(--error);
            margin-bottom: 14px;
        }
    </style>
</head>
<body>

<div class="card">

    {{-- Logo --}}
    <div class="logo-wrap" style="margin-bottom: 16px;">
        <div style="background: #1a3c2e; border-radius: 12px; padding: 14px 18px 12px; display: inline-block; text-align: left;">
            <h1 style="font-family: 'Playfair Display', serif; font-size: 1.4rem; font-weight: 900; line-height: 0.85; letter-spacing: -0.02em; color: #fff; margin: 0;">
                MA<br>KE<br>CEN<span style="display: inline-block; transform: translateY(-1px); font-family: 'DM Sans', sans-serif; font-weight: 700; font-size: 1.15rem;">T</span>S
            </h1>
        </div>
        <span class="logo-sub" style="margin-top: 6px;">Coffee Space</span>
    </div>

    {{-- Heading --}}
    <div class="heading">
        <h1>Selamat Datang <span>🌿</span></h1>
        <p>Masuk untuk melanjutkan perjalanan kopi Anda</p>
    </div>

    {{-- Session error --}}
    @if ($errors->any())
        <div class="alert-error">
            {{ $errors->first() }}
        </div>
    @endif

    {{-- Form --}}
    <form method="POST" action="{{ route('login') }}">
        @csrf

        {{-- Email --}}
        <div class="field">
            <label for="email">Alamat Email</label>
            <div class="input-wrap">
                <span class="icon">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="2" y="4" width="20" height="16" rx="2"/>
                        <path d="M2 7l10 7 10-7"/>
                    </svg>
                </span>
                <input
                    id="email"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="Masukkan email Anda"
                    autocomplete="email"
                    class="{{ $errors->has('email') ? 'is-error' : '' }}"
                    required
                    autofocus
                >
            </div>
            @error('email')
                <p class="error-msg">{{ $message }}</p>
            @enderror
        </div>

        {{-- Password --}}
        <div class="field">
            <label for="password">Kata Sandi</label>
            <div class="input-wrap">
                <span class="icon">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="11" width="18" height="11" rx="2"/>
                        <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                    </svg>
                </span>
                <input
                    id="password"
                    type="password"
                    name="password"
                    placeholder="Masukkan kata sandi Anda"
                    autocomplete="current-password"
                    class="{{ $errors->has('password') ? 'is-error' : '' }}"
                    required
                >
                <button type="button" class="toggle-pw" onclick="togglePw()" title="Tampilkan password">
                    <svg id="eye-icon" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                        <circle cx="12" cy="12" r="3"/>
                    </svg>
                </button>
            </div>
            @error('password')
                <p class="error-msg">{{ $message }}</p>
            @enderror
        </div>



        {{-- Remember / Forgot --}}
        <div class="row-mid">
            <label class="remember">
                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                Ingat saya
            </label>
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="forgot">Lupa Kata Sandi?</a>
            @endif
        </div>

        {{-- Submit --}}
        <button type="submit" class="btn-login" style="margin-bottom: 12px;">Masuk</button>

        {{-- Guest Login --}}
        <a href="{{ route('guest.login') }}" class="btn-login" style="background: #ffffff; color: var(--green-btn); border: 1.5px solid var(--green-btn); text-decoration: none; display: block; text-align: center; box-shadow: none;">Login sebagai tamu</a>

    </form>

    {{-- Register --}}
    <p class="register-row">
        Belum punya akun? <a href="{{ route('register') }}">Daftar</a>
    </p>

</div>

<script>
function togglePw() {
    const input = document.getElementById('password');
    const icon  = document.getElementById('eye-icon');
    const isHidden = input.type === 'password';
    input.type = isHidden ? 'text' : 'password';
    icon.innerHTML = isHidden
        ? `<line x1="1" y1="1" x2="23" y2="23"/>
           <path d="M10.5 6.5A5 5 0 0 1 17.5 13.5M6.6 6.6C4.3 8 2.5 10 1 12c1.7 2.9 5.1 7 11 7a11 11 0 0 0 5.4-1.4M9.9 4.2A9.6 9.6 0 0 1 12 4c5.9 0 9.3 4.1 11 7a18.6 18.6 0 0 1-2.6 3.6"/>`
        : `<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>`;
}


</script>

</body>
</html>
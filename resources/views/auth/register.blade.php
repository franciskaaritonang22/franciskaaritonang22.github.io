<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register — MakeCents Coffee Space</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        /* CSS yang sama dengan login.blade.php untuk konsistensi */
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --green-dark:  #1a3c2e;
            --green-mid:   #2d5a3f;
            --green-btn:   #1f4d34;
            --green-hover: #163828;
            --green-light: #e8f0eb;
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
            padding: 40px 24px;
        }
        
        .card {
            background: var(--card-bg);
            border-radius: 18px;
            padding: 24px 24px 22px;
            width: 100%;
            max-width: 360px;
            box-shadow: 0 32px 80px rgba(10,30,18,0.45);
            animation: slideUp .45s cubic-bezier(.22,.68,0,1.2) both;
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(24px) scale(.97); }
            to   { opacity: 1; transform: none; }
        }

        /* Logo & Heading */
        .logo-wrap { display: flex; flex-direction: column; align-items: center; gap: 4px; margin-bottom: 12px; }
        .logo-icon { width: 48px; height: 48px; }
        .logo-name { font-family: 'Playfair Display', serif; font-size: 12px; letter-spacing: .18em; color: var(--text-main); text-transform: uppercase; }
        .logo-sub { font-size: 9px; letter-spacing: .22em; color: var(--text-sub); text-transform: uppercase; }

        .heading { text-align: center; margin-bottom: 16px; }
        .heading h1 { font-family: 'Playfair Display', serif; font-size: 20px; color: var(--text-main); display: flex; align-items: center; justify-content: center; gap: 6px; }
        .heading p { font-size: 11.5px; color: var(--text-sub); margin-top: 4px; }

        /* Form styling */
        .field { margin-bottom: 12px; }
        .field label { display: block; font-size: 11.5px; font-weight: 600; color: var(--text-main); margin-bottom: 5px; }
        
        .input-wrap { position: relative; display: flex; align-items: center; }
        .input-wrap .icon { position: absolute; left: 12px; color: var(--text-sub); display: flex; pointer-events: none; }
        .input-wrap .icon svg { width: 14px; height: 14px; }
        .input-wrap input {
            width: 100%; padding: 10px 12px 10px 36px; border: 1.5px solid var(--border);
            border-radius: 8px; font-family: 'DM Sans', sans-serif; font-size: 12.5px;
            color: var(--text-main); background: #fafcfb; transition: all .2s; outline: none;
        }
        .input-wrap input:focus { border-color: var(--accent); box-shadow: 0 0 0 3px rgba(74,140,92,.14); background: #fff; }
        
        .toggle-pw { position: absolute; right: 12px; background: none; border: none; cursor: pointer; color: var(--text-sub); display: flex; padding: 4px; }

        /* Terms & Checkbox */
        .terms-row { display: flex; align-items: flex-start; gap: 8px; margin: 14px 0; cursor: pointer; }
        .terms-row input { width: 14px; height: 14px; accent-color: var(--green-btn); margin-top: 2px; }
        .terms-text { font-size: 11px; color: var(--text-sub); line-height: 1.4; }
        .terms-text a { color: var(--green-btn); font-weight: 600; text-decoration: none; }

        .btn-reg {
            width: 100%; padding: 11px; background: var(--green-btn); color: #fff; border: none;
            border-radius: 10px; font-family: 'DM Sans', sans-serif; font-size: 13px; font-weight: 600;
            cursor: pointer; transition: all .2s; box-shadow: 0 4px 16px rgba(31,77,52,.28);
        }
        .btn-reg:hover { background: var(--green-hover); transform: translateY(-1px); }

        .login-row { text-align: center; margin-top: 16px; font-size: 12px; color: var(--text-sub); }
        .login-row a { color: var(--accent); font-weight: 600; text-decoration: none; }
        
        .error-msg { font-size: 11px; color: var(--error); margin-top: 4px; }
        .input-wrap input.is-error { border-color: var(--error); }
    </style>
</head>
<body>

<div class="card">
    <div class="logo-wrap" style="margin-bottom: 16px;">
        <div style="background: #1a3c2e; border-radius: 12px; padding: 14px 18px 12px; display: inline-block; text-align: left;">
            <h1 style="font-family: 'Playfair Display', serif; font-size: 1.4rem; font-weight: 900; line-height: 0.85; letter-spacing: -0.02em; color: #fff; margin: 0;">
                MA<br>KE<br>CEN<span style="display: inline-block; transform: translateY(-1px); font-family: 'DM Sans', sans-serif; font-weight: 700; font-size: 1.15rem;">T</span>S
            </h1>
        </div>
        <span class="logo-sub" style="margin-top: 6px;">Coffee Space</span>
    </div>

    <div class="heading">
        <h1>Buat Akun <span>🌿</span></h1>
        <p>Bergabung dengan MakeCents dan nikmati pengalaman kopi spesial</p>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="field">
            <label for="name">Nama Lengkap</label>
            <div class="input-wrap">
                <span class="icon">
                    <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                </span>
                <input id="name" type="text" name="name" value="{{ old('name') }}" placeholder="Masukkan nama lengkap" required class="{{ $errors->has('name') ? 'is-error' : '' }}">
            </div>
            @error('name') <p class="error-msg">{{ $message }}</p> @enderror
        </div>

        <div class="field">
            <label for="email">Alamat Email</label>
            <div class="input-wrap">
                <span class="icon">
                    <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="M2 7l10 7 10-7"/></svg>
                </span>
                <input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="Masukkan email Anda" required class="{{ $errors->has('email') ? 'is-error' : '' }}">
            </div>
            @error('email') <p class="error-msg">{{ $message }}</p> @enderror
        </div>

        <div class="field">
            <label for="password">Kata Sandi</label>
            <div class="input-wrap">
                <span class="icon">
                    <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                </span>
                <input id="password" type="password" name="password" placeholder="Buat kata sandi" required class="{{ $errors->has('password') ? 'is-error' : '' }}">
            </div>
            @error('password') <p class="error-msg">{{ $message }}</p> @enderror
        </div>

        <div class="field">
            <label for="password_confirmation">Konfirmasi Kata Sandi</label>
            <div class="input-wrap">
                <span class="icon">
                    <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                </span>
                <input id="password_confirmation" type="password" name="password_confirmation" placeholder="Konfirmasi kata sandi" required>
            </div>
        </div>

        <label class="terms-row">
            <input type="checkbox" name="terms" required>
            <span class="terms-text">
                Saya setuju dengan <a href="#">Syarat & Ketentuan</a> dan <a href="#">Kebijakan Privasi</a>
            </span>
        </label>

        <button type="submit" class="btn-reg">Daftar</button>
    </form>

    <p class="login-row">
        Sudah punya akun? <a href="{{ route('login') }}">Masuk</a>
    </p>
</div>

</body>
</html>
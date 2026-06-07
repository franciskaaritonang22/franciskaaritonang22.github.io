<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Tamu — MakeCents Coffee Space</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --green-dark:  #1a3c2e;
            --green-btn:   #1f4d34;
            --green-hover: #163828;
            --accent:      #4a8c5c;
            --text-main:   #1a2e22;
            --text-sub:    #6b7c71;
            --border:      #c8dace;
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
        .field { margin-bottom: 16px; }
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

        /* Error state */
        .input-wrap input.is-error { border-color: var(--error); }
        .error-msg {
            font-size: 11px;
            color: var(--error);
            margin-top: 4px;
        }

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

        .back-row {
            text-align: center;
            margin-top: 16px;
            font-size: 12px;
            color: var(--text-sub);
        }
        .back-row a {
            color: var(--accent);
            font-weight: 600;
            text-decoration: none;
            transition: color .2s;
        }
        .back-row a:hover { color: var(--green-dark); }
        
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
    <div class="logo-wrap" style="margin-bottom: 16px;">
        <div style="background: #1a3c2e; border-radius: 12px; padding: 14px 18px 12px; display: inline-block; text-align: left;">
            <h1 style="font-family: 'Playfair Display', serif; font-size: 1.4rem; font-weight: 900; line-height: 0.85; letter-spacing: -0.02em; color: #fff; margin: 0;">
                MA<br>KE<br>CEN<span style="display: inline-block; transform: translateY(-1px); font-family: 'DM Sans', sans-serif; font-weight: 700; font-size: 1.15rem;">T</span>S
            </h1>
        </div>
        <span class="logo-sub" style="margin-top: 6px;">Coffee Space</span>
    </div>

    <div class="heading">
        <h1>Halo Tamu <span>👋</span></h1>
        <p>Silakan isi nama Anda untuk melanjutkan</p>
    </div>

    @if ($errors->any())
        <div class="alert-error">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('guest.login.store') }}">
        @csrf

        <div class="field">
            <label for="name">Nama Panggilan</label>
            <div class="input-wrap">
                <span class="icon">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                        <circle cx="12" cy="7" r="4"/>
                    </svg>
                </span>
                <input
                    id="name"
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    placeholder="Masukkan nama Anda"
                    class="{{ $errors->has('name') ? 'is-error' : '' }}"
                    required
                    autofocus
                >
            </div>
            @error('name')
                <p class="error-msg">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="btn-login">Masuk sebagai Tamu</button>
    </form>

    <p class="back-row">
        Bukan tamu? <a href="{{ route('login') }}">Kembali ke Login</a>
    </p>

</div>

</body>
</html>

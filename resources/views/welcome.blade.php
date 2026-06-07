<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MakeCents Coffee Space</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700;900&family=DM+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --green-dark: #112d1e;
            --green-mid: #1f4a33;
            --green-light: #2a6b4a;
            --accent: #4a8c5c;
            --bg-body: #f5f5f0;
            --bg-card: #ffffff;
            --text-primary: #111111;
            --text-secondary: #666666;
            --text-muted: #999999;
            --border: #e8e8e4;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background-color: var(--bg-body);
            color: var(--text-primary);
            line-height: 1.6;
            overflow-x: hidden;
        }

        /* Typography */
        h1, h2, h3 {
            font-family: 'Playfair Display', serif;
            color: var(--green-dark);
        }

        /* Container */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 24px;
        }

        /* Navigation */
        nav {
            padding: 24px 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: relative;
        }

        /* Mobile hamburger */
        .nav-hamburger-btn {
            display: none;
            background: rgba(17,45,30,0.07);
            border: none;
            border-radius: 10px;
            padding: 8px;
            cursor: pointer;
            color: var(--green-dark);
            align-items: center;
            justify-content: center;
        }
        .nav-mobile-menu {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.4);
            z-index: 998;
            backdrop-filter: blur(4px);
        }
        .nav-mobile-menu.open { display: block; }
        .nav-mobile-panel {
            position: fixed;
            top: 0; right: 0; bottom: 0;
            width: 240px;
            background: #fff;
            z-index: 999;
            padding: 28px 24px;
            display: flex;
            flex-direction: column;
            gap: 8px;
            box-shadow: -4px 0 24px rgba(0,0,0,0.12);
            transform: translateX(100%);
            transition: transform 0.3s cubic-bezier(.4,0,.2,1);
        }
        .nav-mobile-menu.open .nav-mobile-panel {
            transform: translateX(0);
        }
        .nav-mobile-close {
            background: rgba(17,45,30,0.07);
            border: none;
            border-radius: 8px;
            padding: 6px;
            cursor: pointer;
            color: var(--green-dark);
            align-self: flex-start;
            margin-bottom: 8px;
        }
        .nav-mobile-link {
            display: block;
            padding: 12px 16px;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 600;
            font-size: 15px;
            color: var(--green-dark);
            transition: background 0.2s;
        }
        .nav-mobile-link:hover { background: rgba(17,45,30,0.06); }
        .nav-mobile-link.primary {
            background: var(--green-dark);
            color: #fff;
            text-align: center;
            margin-top: 4px;
        }
        .nav-mobile-link.primary:hover { background: var(--green-mid); }

        .logo {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
        }

        .logo-box {
            background: var(--green-dark);
            border-radius: 12px;
            padding: 10px 14px 8px;
            display: inline-block;
            text-align: left;
        }

        .logo-box h1 {
            font-family: 'Playfair Display', serif;
            font-size: 1.2rem;
            font-weight: 900;
            line-height: 0.85;
            letter-spacing: -0.02em;
            color: #fff;
            margin: 0;
        }

        .logo-box span {
            display: inline-block;
            transform: translateY(-1px);
            font-family: 'DM Sans', sans-serif;
            font-weight: 700;
            font-size: 1rem;
        }

        .logo-text {
            font-size: 14px;
            font-weight: 700;
            color: var(--green-dark);
            letter-spacing: 0.05em;
            text-transform: uppercase;
        }

        .nav-links {
            display: flex;
            gap: 16px;
            align-items: center;
        }

        .btn-login {
            color: var(--green-dark);
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            padding: 10px 20px;
            border-radius: 12px;
            transition: all 0.2s;
        }

        .btn-login:hover {
            background: rgba(17, 45, 30, 0.05);
        }

        .btn-register {
            background: var(--green-dark);
            color: #fff;
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            padding: 10px 24px;
            border-radius: 12px;
            transition: all 0.2s;
            box-shadow: 0 4px 12px rgba(17, 45, 30, 0.15);
        }

        .btn-register:hover {
            background: var(--green-mid);
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(17, 45, 30, 0.25);
        }

        /* Hero Section */
        .hero {
            padding: 80px 0 100px;
            display: flex;
            align-items: center;
            gap: 60px;
        }

        .hero-content {
            flex: 1;
        }

        .hero-title {
            font-size: 4rem;
            line-height: 1.1;
            margin-bottom: 24px;
            font-weight: 900;
        }

        .hero-title span {
            color: var(--accent);
            position: relative;
            display: inline-block;
        }

        .hero-title span::after {
            content: '';
            position: absolute;
            bottom: 8px;
            left: 0;
            width: 100%;
            height: 12px;
            background: rgba(74, 140, 92, 0.2);
            z-index: -1;
            border-radius: 4px;
        }

        .hero-desc {
            font-size: 1.1rem;
            color: var(--text-secondary);
            margin-bottom: 40px;
            max-width: 480px;
        }

        .hero-actions {
            display: flex;
            gap: 16px;
        }

        .btn-primary {
            background: var(--green-dark);
            color: #fff;
            text-decoration: none;
            font-weight: 700;
            font-size: 15px;
            padding: 16px 32px;
            border-radius: 14px;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 8px 24px rgba(17, 45, 30, 0.2);
        }

        .btn-primary:hover {
            background: var(--green-mid);
            transform: translateY(-2px);
            box-shadow: 0 12px 32px rgba(17, 45, 30, 0.3);
        }

        .btn-secondary {
            background: var(--bg-card);
            color: var(--green-dark);
            text-decoration: none;
            font-weight: 700;
            font-size: 15px;
            padding: 16px 32px;
            border-radius: 14px;
            border: 1.5px solid var(--border);
            transition: all 0.2s;
        }

        .btn-secondary:hover {
            border-color: var(--green-dark);
            background: #fafafa;
        }

        .hero-image {
            flex: 1;
            position: relative;
        }

        .image-card {
            background: var(--bg-card);
            padding: 16px;
            border-radius: 24px;
            box-shadow: 0 24px 48px rgba(17, 45, 30, 0.08);
            transform: rotate(2deg);
            transition: transform 0.4s ease;
        }

        .image-card:hover {
            transform: rotate(0deg) translateY(-10px);
        }

        .image-card img {
            width: 100%;
            height: 480px;
            object-fit: cover;
            border-radius: 16px;
        }

        /* Features Section */
        .features {
            padding: 80px 0;
            background: var(--green-dark);
            color: #fff;
            position: relative;
        }

        .features::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(rgba(255,255,255,0.05) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,0.05) 1px, transparent 1px);
            background-size: 40px 40px;
            opacity: 0.5;
            pointer-events: none;
        }

        .features .container {
            position: relative;
            z-index: 1;
        }

        .section-header {
            text-align: center;
            margin-bottom: 60px;
        }

        .section-header h2 {
            color: #fff;
            font-size: 2.5rem;
            margin-bottom: 16px;
        }

        .section-header p {
            color: rgba(255, 255, 255, 0.7);
            font-size: 1.1rem;
            max-width: 500px;
            margin: 0 auto;
        }

        .feature-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 32px;
        }

        .feature-card {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            padding: 32px;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
        }

        .feature-card:hover {
            transform: translateY(-8px);
            background: rgba(255, 255, 255, 0.08);
            border-color: rgba(255, 255, 255, 0.2);
        }

        .feature-icon {
            width: 48px;
            height: 48px;
            background: var(--accent);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 24px;
            color: #fff;
        }

        .feature-card h3 {
            color: #fff;
            font-size: 1.25rem;
            margin-bottom: 12px;
            font-family: 'DM Sans', sans-serif;
            font-weight: 700;
        }

        .feature-card p {
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.95rem;
            line-height: 1.6;
        }

        /* Footer */
        footer {
            padding: 40px 0;
            text-align: center;
            color: var(--text-secondary);
            font-size: 0.9rem;
            border-top: 1px solid var(--border);
            background: var(--bg-body);
        }

        /* Responsive */
        @media (max-width: 992px) {
            .hero {
                flex-direction: column;
                text-align: center;
                padding: 60px 20px;
            }
            .hero-desc {
                margin: 0 auto 40px;
            }
            .hero-actions {
                justify-content: center;
            }
            .hero-title {
                font-size: 3rem;
            }
            .feature-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
 
        @media (max-width: 768px) {
            .nav-links { display: none; }
            .nav-hamburger-btn { display: flex; }
            .hero { padding: 40px 20px 60px; }
            .hero-title { font-size: 2.4rem; }
            .hero-image { width: 100%; }
            .image-card img { height: 280px; }
            .feature-grid { grid-template-columns: 1fr; }
            .hero-desc { font-size: 1rem; }
            .section-header h2 { font-size: 2rem; }
            .feature-card { padding: 24px; }
        }
        @media (max-width: 480px) {
            .hero-title { font-size: 1.7rem; }
            .hero-desc { font-size: 0.9rem; margin-bottom: 24px; }
            .btn-primary, .btn-secondary { padding: 11px 20px; font-size: 14px; }
            .hero-actions { flex-direction: column; align-items: stretch; gap: 12px; max-width: 290px; margin: 0 auto; width: 100%; }
            .hero-actions a { text-align: center; justify-content: center; }
        }
    </style>
</head>
<body>

    <div class="container">
        <nav>
            <a href="/" class="logo">
                <div class="logo-box">
                    <h1>MA<br>KE<br>CEN<span>T</span>S</h1>
                </div>
                <div class="logo-text">Coffee Space</div>
            </a>
            
            <div class="nav-links">
                @auth
                    <a href="{{ route('dashboard') }}" class="btn-primary" style="padding: 10px 24px;">Ke Dasbor</a>
                @else
                    <a href="{{ route('login') }}" class="btn-login">Masuk</a>
                    <a href="{{ route('register') }}" class="btn-register">Daftar</a>
                @endauth
            </div>

            {{-- Mobile hamburger button --}}
            <button class="nav-hamburger-btn" onclick="openWelcomeNav()" aria-label="Menu">
                <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                    <line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/>
                </svg>
            </button>
        </nav>
    </div>

    {{-- Mobile Nav Overlay + Panel --}}
    <div class="nav-mobile-menu" id="welcomeMobileNav" onclick="closeWelcomeNav()">
        <div class="nav-mobile-panel" onclick="event.stopPropagation()">
            <button class="nav-mobile-close" onclick="closeWelcomeNav()">
                <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                    <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
                </svg>
            </button>
            <div style="margin-bottom:16px;">
                <div style="font-size:1.4rem;font-weight:900;color:var(--green-dark);letter-spacing:-0.03em;">MAKECENTS</div>
                <div style="font-size:11px;color:var(--text-muted);letter-spacing:0.15em;text-transform:uppercase;">Coffee Space</div>
            </div>
            @auth
                <a href="{{ route('dashboard') }}" class="nav-mobile-link primary">Ke Dasbor</a>
            @else
                <a href="{{ route('login') }}" class="nav-mobile-link">Masuk</a>
                <a href="{{ route('register') }}" class="nav-mobile-link primary">Daftar Sekarang</a>
            @endauth
        </div>
    </div>

    <section class="hero container">
        <div class="hero-content">
            <h1 class="hero-title">Nikmati <span>Kopi</span><br>Seperti Belum Pernah Ada Sebelumnya.</h1>
            <p class="hero-desc">Selamat datang di MakeCents Coffee Space. Tempat di mana setiap biji kopi diseduh dengan penuh gairah, menciptakan momen yang bermakna untuk rutinitas harian Anda.</p>
            <div class="hero-actions">
                @auth
                    <a href="{{ route('dashboard') }}" class="btn-primary">
                        Lihat Menu
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                            <polyline points="12 5 19 12 12 19"></polyline>
                        </svg>
                    </a>
                @else
                    <a href="{{ route('register') }}" class="btn-primary">
                        Pesan Sekarang
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                            <polyline points="12 5 19 12 12 19"></polyline>
                        </svg>
                    </a>
                    <a href="{{ route('login') }}" class="btn-secondary">Masuk</a>
                @endauth
            </div>
        </div>
        <div class="hero-image">
            <div class="image-card">
                <img src="https://images.unsplash.com/photo-1497935586351-b67a49e012bf?q=80&w=800&auto=format&fit=crop" alt="Coffee Pour">
            </div>
        </div>
    </section>

    <section class="features">
        <div class="container">
            <div class="section-header">
                <h2>Mengapa MakeCents?</h2>
                <p>Kami lebih dari sekadar kedai kopi. Kami adalah ruang yang didedikasikan untuk kualitas, kenyamanan, dan komunitas.</p>
            </div>
            
            <div class="feature-grid">
                <div class="feature-card">
                    <div class="feature-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M18 8h1a4 4 0 0 1 0 8h-1"></path>
                            <path d="M2 8h16v9a4 4 0 0 1-4 4H6a4 4 0 0 1-4-4V8z"></path>
                            <line x1="6" y1="1" x2="6" y2="4"></line>
                            <line x1="10" y1="1" x2="10" y2="4"></line>
                            <line x1="14" y1="1" x2="14" y2="4"></line>
                        </svg>
                    </div>
                    <h3>Biji Kopi Premium</h3>
                    <p>Dipilih dan disangrai dengan saksama untuk menghasilkan profil rasa yang kaya dan autentik di setiap cangkir.</p>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                        </svg>
                    </div>
                    <h3>Kumpulkan Poin</h3>
                    <p>Bergabunglah dengan program loyalitas kami dan dapatkan poin setiap kali bertransaksi. Tukarkan dengan minuman gratis dan diskon eksklusif.</p>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"></circle>
                            <polyline points="12 6 12 12 16 14"></polyline>
                        </svg>
                    </div>
                    <h3>Cepat & Mudah</h3>
                    <p>Lewati antrean! Pesan terlebih dahulu melalui platform kami dan kopi Anda akan siap saat Anda tiba.</p>
                </div>
            </div>
        </div>
    </section>

    <footer>
        <div class="container">
            <p>&copy; {{ date('Y') }} MakeCents Coffee Space. Hak Cipta Dilindungi.</p>
        </div>
    </footer>

</body>
</html>

<script>
    function openWelcomeNav() {
        document.getElementById('welcomeMobileNav').classList.add('open');
        document.body.style.overflow = 'hidden';
    }
    function closeWelcomeNav() {
        document.getElementById('welcomeMobileNav').classList.remove('open');
        document.body.style.overflow = '';
    }
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeWelcomeNav();
    });
</script>

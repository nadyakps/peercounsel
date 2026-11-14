
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>PeerCounsel - Teman untuk Mendengarkan</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            color: #39344E;
            background: #ffffff;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        /* NAVBAR */
        .navbar {
            width: 100%;
            padding: 20px 8%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #ffffff;
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: 0 2px 15px rgba(57, 52, 78, 0.05);
        }

        .logo {
            font-size: 23px;
            font-weight: 800;
            color: #6B5BC7;
        }

        .logo span {
            color: #A99CEB;
        }

        .nav-menu {
            display: flex;
            align-items: center;
            gap: 32px;
            font-size: 14px;
            font-weight: 600;
            color: #777387;
        }

        .nav-menu a:hover {
            color: #6B5BC7;
        }

        /* BUTTON */
        .btn {
            display: inline-block;
            padding: 13px 24px;
            border-radius: 9px;
            font-size: 14px;
            font-weight: 700;
            transition: 0.2s;
            cursor: pointer;
        }

        .btn-primary {
            background: #6B5BC7;
            color: white;
        }

        .btn-primary:hover {
            background: #5748AD;
            transform: translateY(-2px);
        }

        .btn-outline {
            border: 1px solid #6B5BC7;
            color: #6B5BC7;
        }

        .btn-outline:hover {
            background: #F0EDFF;
        }

        /* HERO */
        .hero {
            padding: 90px 8%;
            background: #F7F6FC;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 50px;
        }

        .hero-content {
            max-width: 570px;
        }

        .hero-label {
            display: inline-block;
            background: #F0EDFF;
            color: #6B5BC7;
            padding: 8px 15px;
            border-radius: 30px;
            font-size: 12px;
            font-weight: 700;
            margin-bottom: 22px;
        }

        .hero h1 {
            font-size: 49px;
            line-height: 1.2;
            margin-bottom: 22px;
            color: #39344E;
        }

        .hero h1 span {
            color: #6B5BC7;
        }

        .hero p {
            color: #89869A;
            line-height: 1.8;
            font-size: 16px;
            margin-bottom: 30px;
        }

        .hero-image {
            width: 390px;
            min-height: 320px;
            background: #EAE5FC;
            border-radius: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 35px;
        }

        .hero-image-content {
            background: white;
            border-radius: 22px;
            padding: 35px 25px;
            width: 100%;
            box-shadow: 0 12px 30px rgba(57, 52, 78, 0.07);
        }

        .hero-icon {
            font-size: 55px;
            margin-bottom: 15px;
        }

        .hero-image h3 {
            color: #6B5BC7;
            margin-bottom: 10px;
        }

        .hero-image p {
            font-size: 13px;
            margin: 0;
        }

        /* GENERAL SECTION */
        section {
            padding: 80px 8%;
        }

        .section-heading {
            text-align: center;
            max-width: 650px;
            margin: 0 auto 45px;
        }

        .section-heading h2 {
            font-size: 32px;
            color: #39344E;
            margin-bottom: 15px;
        }

        .section-heading p {
            color: #89869A;
            line-height: 1.7;
        }

        /* ABOUT */
        .about {
            display: flex;
            align-items: center;
            gap: 60px;
        }

        .about-content {
            flex: 1;
        }

        .about-content h2 {
            font-size: 32px;
            color: #39344E;
            margin-bottom: 20px;
        }

        .about-content p {
            color: #89869A;
            line-height: 1.9;
            margin-bottom: 15px;
        }

        .about-highlight {
            flex: 1;
            background: #F0EDFF;
            padding: 40px;
            border-radius: 22px;
        }

        .about-highlight h3 {
            color: #6B5BC7;
            margin-bottom: 15px;
        }

        .about-highlight p {
            color: #777387;
            line-height: 1.8;
        }

        /* STEPS */
        .steps {
            background: #FAF9FE;
        }

        .step-container {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 25px;
        }

        .step-card {
            background: white;
            padding: 30px;
            border-radius: 18px;
            box-shadow: 0 5px 20px rgba(57, 52, 78, 0.035);
            border: 1px solid #F0EDFF;
        }

        .step-number {
            width: 43px;
            height: 43px;
            border-radius: 12px;
            background: #F0EDFF;
            color: #6B5BC7;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            margin-bottom: 20px;
        }

        .step-card h3 {
            margin-bottom: 12px;
            color: #39344E;
        }

        .step-card p {
            font-size: 14px;
            color: #89869A;
            line-height: 1.8;
        }

        /* AI COMPANION */
        .ai-section {
            background: #F5F2FF;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 50px;
        }

        .ai-content {
            max-width: 650px;
        }

        .ai-content h2 {
            font-size: 32px;
            color: #6B5BC7;
            margin-bottom: 18px;
        }

        .ai-content p {
            color: #777387;
            line-height: 1.8;
            margin-bottom: 15px;
        }

        .ai-note {
            background: white;
            border-left: 4px solid #A99CEB;
            padding: 17px;
            border-radius: 8px;
            font-size: 13px;
            color: #777387;
            line-height: 1.7;
        }

        .ai-icon {
            font-size: 90px;
        }

        /* CTA */
        .cta {
            text-align: center;
            background: #6B5BC7;
            color: white;
        }

        .cta h2 {
            font-size: 32px;
            margin-bottom: 15px;
        }

        .cta p {
            color: #EAE5FC;
            margin-bottom: 28px;
        }

        .cta .btn {
            background: white;
            color: #6B5BC7;
        }

        .cta .btn:hover {
            background: #F0EDFF;
            transform: translateY(-2px);
        }

        /* FOOTER */
        footer {
            padding: 30px 8%;
            text-align: center;
            background: #39344E;
            color: #EAE5FC;
            font-size: 13px;
        }

        /* RESPONSIVE */
        @media (max-width: 768px) {
            .navbar {
                padding: 18px 6%;
                flex-wrap: wrap;
                gap: 15px;
            }

            .nav-menu {
                gap: 15px;
                flex-wrap: wrap;
                font-size: 12px;
            }

            .hero,
            .about,
            .ai-section {
                flex-direction: column;
                padding: 60px 6%;
            }

            .hero h1 {
                font-size: 36px;
            }

            .hero-image {
                width: 100%;
            }

            .step-container {
                grid-template-columns: 1fr;
            }

            section {
                padding: 60px 6%;
            }

            .section-heading h2,
            .about-content h2,
            .ai-content h2,
            .cta h2 {
                font-size: 27px;
            }
        }
    </style>
</head>

<body>

    <!-- NAVBAR -->
    <nav class="navbar">

        <a href="{{ route('home') }}" class="logo">
            Peer<span>Counsel.</span>
        </a>

        <div class="nav-menu">

            <a href="#beranda">Beranda</a>
            <a href="#tentang">Tentang</a>
            <a href="#cara-kerja">Cara Kerja</a>

            @auth
                <a href="{{ route('dashboard') }}" class="btn btn-primary">
                    Dashboard
                </a>
            @else
                <a href="{{ route('login') }}">Masuk</a>

                <a href="{{ route('register') }}" class="btn btn-primary">
                    Daftar
                </a>
            @endauth

        </div>
    </nav>

    <!-- HERO SECTION -->
    <section class="hero" id="beranda">

        <div class="hero-content">

            <span class="hero-label">
                Ruang Aman untuk Berbagi Cerita
            </span>

            <h1>
                Tidak Harus Menghadapi Semuanya <span>Sendiri.</span>
            </h1>

            <p>
                PeerCounsel merupakan platform konseling sebaya
                yang menyediakan ruang bagi kamu untuk berbagi cerita,
                mendapatkan dukungan, dan terhubung dengan konselor sebaya.
            </p>

            @auth
                <a href="{{ route('dashboard') }}" class="btn btn-primary">
                    Buka Dashboard
                </a>
            @else
                <a href="{{ route('register') }}" class="btn btn-primary">
                    Mulai Konseling
                </a>

                <a href="{{ route('login') }}" class="btn btn-outline">
                    Masuk
                </a>
            @endauth

        </div>

        <div class="hero-image">

            <div class="hero-image-content">

                <div class="hero-icon">💬</div>

                <h3>Didengarkan Tanpa Menghakimi</h3>

                <p>
                    Setiap cerita layak mendapatkan ruang
                    untuk didengarkan.
                </p>

            </div>

        </div>

    </section>

    <!-- ABOUT SECTION -->
    <section class="about" id="tentang">

        <div class="about-content">

            <h2>Tentang PeerCounsel</h2>

            <p>
                PeerCounsel adalah platform konseling sebaya
                berbasis web yang membantu pengguna mendapatkan
                dukungan melalui komunikasi dengan konselor sebaya.
            </p>

            <p>
                Melalui platform ini, konseli dapat mengajukan
                permintaan konseling, berkomunikasi dengan konselor,
                serta melihat riwayat percakapan sebelumnya.
            </p>

        </div>

        <div class="about-highlight">

            <h3>Kenapa PeerCounsel?</h3>

            <p>
                Kami ingin menyediakan ruang komunikasi yang
                mudah diakses, nyaman, dan mendukung pengguna
                untuk menyampaikan cerita tanpa merasa sendirian.
            </p>

        </div>

    </section>

    <!-- HOW IT WORKS -->
    <section class="steps" id="cara-kerja">

        <div class="section-heading">

            <h2>Bagaimana Cara Kerjanya?</h2>

            <p>
                Mulai perjalanan konselingmu melalui tiga
                langkah sederhana.
            </p>

        </div>

        <div class="step-container">

            <div class="step-card">

                <div class="step-number">01</div>

                <h3>Buat Akun</h3>

                <p>
                    Daftarkan akun untuk mulai menggunakan
                    layanan PeerCounsel.
                </p>

            </div>

            <div class="step-card">

                <div class="step-number">02</div>

                <h3>Ajukan Konseling</h3>

                <p>
                    Pilih konselor sebaya dan sampaikan
                    topik atau cerita yang ingin kamu diskusikan.
                </p>

            </div>

            <div class="step-card">

                <div class="step-number">03</div>

                <h3>Mulai Berbagi Cerita</h3>

                <p>
                    Lanjutkan percakapan bersama konselor.
                    AI Companion dapat menemani sementara
                    ketika konselor belum tersedia.
                </p>

            </div>

        </div>

    </section>

    <!-- AI COMPANION -->
    <section class="ai-section">

        <div class="ai-content">

            <h2>Butuh Teman Bicara Sementara?</h2>

            <p>
                AI Companion hadir sebagai pendamping sementara
                ketika konselor belum tersedia atau belum
                membalas percakapanmu.
            </p>

            <p>
                AI Companion dapat mendengarkan cerita,
                memberikan respons empatik, dan mengajukan
                pertanyaan sederhana untuk membantu kamu
                mengungkapkan perasaan.
            </p>

            <div class="ai-note">
                AI Companion bukan psikolog atau tenaga profesional
                kesehatan mental. AI tidak memberikan diagnosis
                maupun pengganti bantuan profesional. Riwayat
                percakapan AI dapat dibaca konselor ketika
                melanjutkan sesi konseling.
            </div>

        </div>

        <div class="ai-icon">🤝</div>

    </section>

    <!-- CALL TO ACTION -->
    <section class="cta">

        <h2>Setiap Cerita Berarti.</h2>

        <p>
            Mulai langkah kecil untuk berbagi cerita
            dan mendapatkan dukungan.
        </p>

        @auth
            <a href="{{ route('dashboard') }}" class="btn">
                Buka Dashboard
            </a>
        @else
            <a href="{{ route('register') }}" class="btn">
                Gabung PeerCounsel
            </a>
        @endauth

    </section>

    <!-- FOOTER -->
    <footer>

        <p>
            © {{ date('Y') }} PeerCounsel.
            Ruang Aman untuk Berbagi Cerita.
        </p>

    </footer>

</body>
</html>

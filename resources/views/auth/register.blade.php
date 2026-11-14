
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - PeerCounsel</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', sans-serif;
        }

        body {
            min-height: 100vh;
            background: #f7f6fc;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 30px;
        }

        .register-container {
            width: 100%;
            max-width: 1050px;
            min-height: 680px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            background: #ffffff;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 15px 50px rgba(58, 43, 110, 0.10);
        }

        .welcome-panel {
            background: linear-gradient(145deg, #6656c8, #8979df);
            padding: 55px;
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: relative;
            overflow: hidden;
        }

        .brand {
            font-size: 25px;
            font-weight: 750;
            letter-spacing: -0.5px;
        }

        .brand span {
            color: #e1dcff;
        }

        .welcome-content {
            position: relative;
            z-index: 1;
        }

        .welcome-content h1 {
            font-size: 38px;
            line-height: 1.25;
            margin-bottom: 18px;
        }

        .welcome-content p {
            font-size: 15px;
            line-height: 1.8;
            color: #eeebff;
            max-width: 350px;
        }

        .welcome-icon {
            width: 110px;
            height: 110px;
            border-radius: 30px;
            background: rgba(255,255,255,0.16);
            border: 1px solid rgba(255,255,255,0.25);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 55px;
            margin-bottom: 30px;
        }

        .welcome-footer {
            font-size: 12px;
            color: #e3dfff;
            position: relative;
            z-index: 1;
        }

        .circle {
            position: absolute;
            border-radius: 50%;
            background: rgba(255,255,255,0.07);
        }

        .circle-one {
            width: 300px;
            height: 300px;
            right: -120px;
            top: 80px;
        }

        .circle-two {
            width: 200px;
            height: 200px;
            right: 100px;
            bottom: -120px;
        }

        .form-panel {
            padding: 50px 60px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .form-heading {
            margin-bottom: 28px;
        }

        .form-heading h2 {
            font-size: 29px;
            color: #29243f;
            margin-bottom: 10px;
        }

        .form-heading p {
            color: #89869a;
            font-size: 14px;
            line-height: 1.6;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;
            color: #39344e;
            font-size: 13px;
            font-weight: 650;
            margin-bottom: 9px;
        }

        .form-control {
            width: 100%;
            height: 47px;
            border: 1px solid #e4e1ed;
            border-radius: 10px;
            padding: 0 15px;
            font-size: 14px;
            color: #39344e;
            outline: none;
            background: #ffffff;
            transition: 0.2s;
        }

        .form-control:focus {
            border-color: #7665d4;
            box-shadow: 0 0 0 3px rgba(118,101,212,0.10);
        }

        .form-control::placeholder {
            color: #b0adbd;
        }

        .register-button {
            width: 100%;
            height: 50px;
            background: #6b5bc7;
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 15px;
            font-weight: 650;
            cursor: pointer;
            transition: 0.2s;
            margin-top: 5px;
        }

        .register-button:hover {
            background: #5848b3;
            transform: translateY(-1px);
        }

        .login-text {
            text-align: center;
            margin-top: 24px;
            color: #89869a;
            font-size: 13px;
        }

        .login-link {
            color: #6b5bc7;
            text-decoration: none;
            font-weight: 600;
        }

        .login-link:hover {
            text-decoration: underline;
        }

        .error-message {
            color: #dc4545;
            font-size: 12px;
            margin-top: 7px;
        }

        @media (max-width: 768px) {
            body {
                padding: 15px;
            }

            .register-container {
                grid-template-columns: 1fr;
                max-width: 480px;
            }

            .welcome-panel {
                padding: 30px;
                min-height: 250px;
            }

            .welcome-content {
                margin-top: 35px;
            }

            .welcome-content h1 {
                font-size: 27px;
            }

            .welcome-content p {
                font-size: 13px;
            }

            .welcome-icon {
                display: none;
            }

            .welcome-footer {
                margin-top: 30px;
            }

            .form-panel {
                padding: 35px 28px;
            }

            .form-heading h2 {
                font-size: 25px;
            }
        }
    </style>
</head>

<body>

    <div class="register-container">

        {{-- Panel Kiri --}}
        <div class="welcome-panel">

            <div class="circle circle-one"></div>
            <div class="circle circle-two"></div>

            <div class="brand">
                Peer<span>Counsel.</span>
            </div>

            <div class="welcome-content">

                <div class="welcome-icon">
                    🌱
                </div>

                <h1>Your journey starts with a conversation.</h1>

                <p>
                    Bergabunglah dengan PeerCounsel dan temukan
                    ruang aman untuk berbagi cerita, saling mendukung,
                    dan berkembang bersama.
                </p>

            </div>

            <div class="welcome-footer">
                © {{ date('Y') }} PeerCounsel. All rights reserved.
            </div>

        </div>

        {{-- Panel Kanan --}}
        <div class="form-panel">

            <div class="form-heading">

                <h2>Create Account</h2>

                <p>
                    Buat akunmu dan mulai perjalanan konseling
                    bersama PeerCounsel.
                </p>

            </div>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                {{-- Nama --}}
                <div class="form-group">

                    <label for="name">
                        Full Name
                    </label>

                    <input
                        id="name"
                        class="form-control"
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        placeholder="Masukkan nama lengkap"
                        required
                        autofocus
                        autocomplete="name"
                    >

                    @error('name')
                        <div class="error-message">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

                {{-- Email --}}
                <div class="form-group">

                    <label for="email">
                        Email Address
                    </label>

                    <input
                        id="email"
                        class="form-control"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="Masukkan email kamu"
                        required
                        autocomplete="username"
                    >

                    @error('email')
                        <div class="error-message">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

                {{-- Password --}}
                <div class="form-group">

                    <label for="password">
                        Password
                    </label>

                    <input
                        id="password"
                        class="form-control"
                        type="password"
                        name="password"
                        placeholder="Buat password"
                        required
                        autocomplete="new-password"
                    >

                    @error('password')
                        <div class="error-message">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

                {{-- Konfirmasi Password --}}
                <div class="form-group">

                    <label for="password_confirmation">
                        Confirm Password
                    </label>

                    <input
                        id="password_confirmation"
                        class="form-control"
                        type="password"
                        name="password_confirmation"
                        placeholder="Ulangi password"
                        required
                        autocomplete="new-password"
                    >

                    @error('password_confirmation')
                        <div class="error-message">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

                {{-- Tombol Register --}}
                <button type="submit" class="register-button">
                    Create Account
                </button>

            </form>

            {{-- Link Login --}}
            <div class="login-text">

                Sudah memiliki akun?

                <a href="{{ route('login') }}" class="login-link">
                    Sign In
                </a>

            </div>

        </div>

    </div>

</body>
</html>

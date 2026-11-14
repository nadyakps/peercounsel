
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - PeerCounsel</title>

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

        .login-container {
            width: 100%;
            max-width: 1050px;
            min-height: 620px;
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
            padding: 65px 60px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .form-heading {
            margin-bottom: 35px;
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
            margin-bottom: 22px;
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
            height: 49px;
            border: 1px solid #e4e1ed;
            border-radius: 10px;
            padding: 0 15px;
            font-size: 14px;
            color: #39344e;
            outline: none;
            transition: 0.2s;
            background: #ffffff;
        }

        .form-control:focus {
            border-color: #7665d4;
            box-shadow: 0 0 0 3px rgba(118,101,212,0.10);
        }

        .form-control::placeholder {
            color: #b0adbd;
        }

        .remember-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 2px;
            margin-bottom: 25px;
            gap: 10px;
        }

        .remember-label {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 13px;
            color: #777387;
        }

        .remember-label input {
            accent-color: #6b5bc7;
            width: 15px;
            height: 15px;
        }

        .forgot-link,
        .register-link {
            color: #6b5bc7;
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
        }

        .forgot-link:hover,
        .register-link:hover {
            text-decoration: underline;
        }

        .login-button {
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
        }

        .login-button:hover {
            background: #5848b3;
            transform: translateY(-1px);
        }

        .register-text {
            text-align: center;
            margin-top: 28px;
            color: #89869a;
            font-size: 13px;
        }

        .status-message {
            background: #effaf3;
            color: #23834d;
            border: 1px solid #ccebd7;
            border-radius: 9px;
            padding: 12px;
            font-size: 13px;
            margin-bottom: 20px;
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

            .login-container {
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

    <div class="login-container">

        {{-- Panel Kiri --}}
        <div class="welcome-panel">

            <div class="circle circle-one"></div>
            <div class="circle circle-two"></div>

            <div class="brand">
                Peer<span>Counsel.</span>
            </div>

            <div class="welcome-content">

                <div class="welcome-icon">
                    💬
                </div>

                <h1>Every story deserves to be heard.</h1>

                <p>
                    Ruang aman untuk berbagi cerita, mendapatkan dukungan,
                    dan tumbuh bersama melalui konseling sebaya.
                </p>

            </div>

            <div class="welcome-footer">
                © {{ date('Y') }} PeerCounsel. All rights reserved.
            </div>

        </div>

        {{-- Panel Kanan --}}
        <div class="form-panel">

            <div class="form-heading">
                <h2>Welcome Back!</h2>

                <p>
                    Selamat datang kembali. Silakan masuk
                    untuk melanjutkan perjalananmu.
                </p>
            </div>

            {{-- Status Session --}}
            @if (session('status'))
                <div class="status-message">
                    {{ session('status') }}
                </div>
            @endif

            {{-- Form Login --}}
            <form method="POST" action="{{ route('login') }}">
                @csrf

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
                        autofocus
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
                        placeholder="Masukkan password kamu"
                        required
                        autocomplete="current-password"
                    >

                    @error('password')
                        <div class="error-message">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

                {{-- Remember Me dan Forgot Password --}}
                <div class="remember-row">

                    <label class="remember-label" for="remember_me">

                        <input
                            id="remember_me"
                            type="checkbox"
                            name="remember"
                        >

                        Remember me

                    </label>

                    @if (Route::has('password.request'))
                        <a
                            class="forgot-link"
                            href="{{ route('password.request') }}"
                        >
                            Forgot Password?
                        </a>
                    @endif

                </div>

                {{-- Tombol Login --}}
                <button type="submit" class="login-button">
                    Sign In
                </button>

            </form>

            {{-- Register --}}
            @if (Route::has('register'))
                <div class="register-text">

                    Belum memiliki akun?

                    <a
                        href="{{ route('register') }}"
                        class="register-link"
                    >
                        Create Account
                    </a>

                </div>
            @endif

        </div>

    </div>

</body>
</html>

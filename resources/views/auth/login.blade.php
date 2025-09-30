<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@400;600;700&family=Dancing+Script&display=swap" rel="stylesheet">
    <!-- Sweet Alert 2 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.10.5/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.10.5/sweetalert2.min.css">
    <title>Login</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Mulish', sans-serif;
            background: 
            linear-gradient(125deg, rgba(233, 59, 129, 0.1), rgba(233, 59, 129, 0.1));
            background-size: cover;
            background-position: center;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            position: relative;
            overflow: hidden;
        }

        .bg-blur {
            position: fixed;
            inset: 0;
            pointer-events: none;
            overflow: hidden;
        }

        .blur-circle {
            position: absolute;
            width: 384px;
            height: 384px;
            background: rgba(233, 59, 129, 0.09);
            border-radius: 50%;
            filter: blur(96px);
        }

        .blur-circle:first-child {
            top: -192px;
            left: -192px;
        }

        .blur-circle:last-child {
            bottom: -192px;
            right: -192px;
        }

        .login-container {
            position: relative;
            width: 100%;
            max-width: 500px;
            z-index: 1;
        }

        .login-card {
            position: relative;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 25px 50px -12px rgba(0,0,0,0.5);
            min-height: 620px;
        }

        /* background blur */
        .login-card .bg-blur {
            position: absolute;
            inset: 0;
            background: url('images/gambar.jpg') center/cover no-repeat;
            filter: blur(15px);
            transform: scale(1.1);
            z-index: 1;
        }

        /* overlay pink */
        .login-card .overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(125deg, rgba(233,59,129,0.2), rgba(233,59,129,0.2));
            z-index: 2;
        }

        /* konten */
        .login-card .content {
            position: relative;
            z-index: 3;
            padding: 40px;
        }

        .tabs {
            display: flex;
            gap: 16px;
            margin-bottom: 35px;
        }

        .tab {
            font-family: 'Mulish', sans-serif;
            flex: 1;
            padding: 12px 24px;
            border-radius: 12px;
            font-weight: bold;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: all 0.3s;
            text-decoration: none;
            border: none;
            cursor: pointer;
            font-size: 16px;
            font-weight: 600;
        }

        .tab-active {
            background: #FFE5E2;
            color: #643843;
            box-shadow: 0 10px 25px rgba(233, 59, 129, 0.3);
        }

        .tab-inactive {
            background: rgba(255, 255, 255, 0.05);
            color: white;
        }

        .tab-inactive:hover {
            background: rgba(255, 255, 255, 0.4);
        }

        .welcome-section {
            text-align: center;
            margin-bottom: 32px;
        }

        .welcome-title {
            font-size: 36px;
            font-weight: 900;
            color: white;
            margin-bottom: 8px;
        }

        .welcome-subtitle {
            color: white;
            font-size: 16px;
            font-weight: 500;
            margin-bottom: 60px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .input-wrapper {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #E93B81;
            pointer-events: none;
        }

        .form-input {
            font-family: 'Mulish', sans-serif;
            width: 100%;
            padding: 16px 16px 16px 48px;
            background: rgba(255, 255, 255, 0.5);
            border: 1px solid rgba(233, 59, 129, 0.3);
            border-radius: 12px;
            color: #643843;
            font-size: 13px;
            font-weight: 600;
            transition: all 0.3s;
        }

        .form-input::-ms-reveal,
        .form-input::-ms-clear {
            display: none;
        }

        .form-input::-webkit-credentials-auto-fill-button,
        .form-input::-webkit-contacts-auto-fill-button {
            visibility: hidden;
            pointer-events: none;
            position: absolute;
        }

        .form-input::placeholder {
            color: #643843;
        }

        .form-input:focus {
            outline: none;
            border-color: rgba(233, 59, 129, 0.3);
            box-shadow: 0 0 0 3px rgba(233, 59, 129, 0.3);
        }

        .password-toggle {
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #E93B81;
            cursor: pointer;
            padding: 0;
            display: flex;
            align-items: center;
            transition: color 0.3s;
        }

        .password-toggle:hover {
            color: #E93B81;
        }

        .error-message {
            margin-top: 8px;
            color: #f87171;
            font-size: 14px;
        }

        .remember-forgot {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
        }

        .remember-label {
            display: flex;
            align-items: center;
            cursor: pointer;
            color: white;
            font-size: 14px;
            font-weight: 550;
        }

        .remember-checkbox {
            width: 16px;
            height: 16px;
            margin-left: 5px;
            margin-right: 8px;
            border-radius: 4px;
            border: 1px solid #E93B81;
            cursor: pointer;
            accent-color: #e93b81;
        }

        .forgot-link {
            color: white;
            text-decoration: none;
            font-size: 14px;
            transition: color 0.3s;
            font-weight: 550;
            margin-right: 5px;
        }

        .submit-btn {
            font-family: 'Mulish', sans-serif;
            margin-top: 50px;
            width: 100%;
            padding: 16px 24px;
            border-radius: 12px;
            background: #FFE5E2;
            color: #643843;
            font-weight: 900;
            font-size: 16px;
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            box-shadow: 0 10px 25px rgba(233, 59, 129, 0.3);
            transition: all 0.3s;
        }

        .submit-btn:hover {
            background: #ffe5e2ff;
            box-shadow: 0 10px 25px rgba(233, 59, 129, 0.6);
            transform: scale(1.02);
        }

        .icon {
            width: 20px;
            height: 20px;
        }

        svg {
            display: block;
        }

        .back-btn {
            position: fixed;
            top: 30px;
            left: 30px;
            z-index: 10;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
        }

        .back-btn svg {
            width: 28px;
            height: 28px;
            stroke: #E93B81;
        }

        /* Custom Sweet Alert Styling */
        .swal2-popup {
            font-family: 'Mulish', sans-serif !important;
            border-radius: 16px !important;
        }

        .swal2-title {
            font-weight: 700 !important;
            color: #643843 !important;
        }

        .swal2-confirm {
            background: #E93B81 !important;
            border-radius: 8px !important;
            padding: 10px 24px !important;
            font-weight: 600 !important;
        }

        .swal2-confirm:focus {
            box-shadow: 0 0 0 3px rgba(233, 59, 129, 0.3) !important;
        }
    </style>
</head>
<body>
    
    <!-- Tombol Back -->
    <a href="{{ route('landing') }}" class="back-btn">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
        </svg>
    </a>

    <!-- Background blur effects -->
    <div class="bg-blur">
        <div class="blur-circle"></div>
        <div class="blur-circle"></div>
    </div>

    <!-- Login Card -->
   <div class="login-container">
    <div class="login-card">
        <!-- Background blur -->
        <div class="bg-blur"></div>
        <div class="overlay"></div>

        <!-- Content -->
        <div class="content">
            <!-- Tab Navigation -->
            <div class="tabs">
                <button class="tab tab-active">
                    <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                    </svg>
                    Masuk
                </button>
                <a href="{{ route('register') }}" class="tab tab-inactive">
                    <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                    </svg>
                    Daftar
                </a>
            </div>

            <!-- Welcome Text -->
            <div class="welcome-section">
                <h1 class="welcome-title">Halo, Selamat Datang!</h1>
                <p class="welcome-subtitle">Masuk Ke Akun Anda</p>
            </div>

            <!-- Login Form -->
            <form method="POST" action="{{ route('login') }}" id="loginForm">
                @csrf

                <!-- Email Address -->
                <div class="form-group">
                    <div class="input-wrapper">
                        <div class="input-icon">
                            <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <input id="email"
                               type="email"
                               name="email"
                               value="{{ old('email') }}"
                               required
                               autofocus
                               autocomplete="username"
                               placeholder="Alamat Email"
                               class="form-input"/>
                    </div>
                </div>

                <!-- Password -->
                <div class="form-group">
                    <div class="input-wrapper">
                        <div class="input-icon">
                            <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                        </div>
                        <input id="password"
                               type="password"
                               name="password"
                               required
                               autocomplete="current-password"
                               placeholder="Kata Sandi"
                               class="form-input"/>
                        <button type="button"
                                onclick="togglePassword()"
                                class="password-toggle">
                            <svg id="eye-icon" class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="remember-forgot">
                    <label for="remember_me" class="remember-label">
                        <input id="remember_me"
                               type="checkbox"
                               name="remember"
                               class="remember-checkbox"/>
                        Ingat Saya
                    </label>

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="forgot-link">
                            Lupa Kata Sandi?
                        </a>
                    @endif
                </div>

                <!-- Sign In Button -->
                <button type="submit" class="submit-btn">
                    Masuk
                </button>
            </form>
        </div>
    </div>
</div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eye-icon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />';
            } else {
                passwordInput.type = 'password';
                eyeIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />';
            }
        }

        // Tampilkan Sweet Alert jika ada error dari Laravel
        @if ($errors->any())
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Login Gagal',
                    text: 'Email atau kata sandi yang Anda masukkan salah. Silakan coba lagi.',
                    confirmButtonText: 'Coba Lagi',
                    confirmButtonColor: '#E93B81'
                });
            });
        @endif

        // Validasi form sebelum submit
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;

            // Validasi input kosong
            if (!email || !password) {
                e.preventDefault();
                Swal.fire({
                    icon: 'warning',
                    title: 'Data Tidak Lengkap',
                    text: 'Mohon isi email dan kata sandi dengan lengkap.',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#E93B81'
                });
            }
        });
    </script>
</body>
</html>
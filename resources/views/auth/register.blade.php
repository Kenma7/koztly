<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@400;600;700&family=Dancing+Script&display=swap" rel="stylesheet">
    <title>Register</title>
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
            margin-bottom: 28px;
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
            margin-bottom: 24px;
        }

        .welcome-title {
            font-size: 32px;
            font-weight: 900;
            color: white;
            margin-bottom: 4px;
        }

        .welcome-subtitle {
            color: white;
            font-size: 15px;
            font-weight: 500;
            margin-bottom: 32px;
        }

        .form-group {
            margin-bottom: 12px;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            margin-bottom: 12px;
        }

        .form-row .form-group {
            margin-bottom: 0;
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

        .form-input, .form-select {
            font-family: 'Mulish', sans-serif;
            width: 100%;
            padding: 14px 16px 14px 48px;
            background: rgba(255, 255, 255, 0.5);
            border: 1px solid rgba(233, 59, 129, 0.3);
            border-radius: 12px;
            color: #643843;
            font-size: 13px;
            font-weight: 600;
            transition: all 0.3s;
        }

        .form-select {
            cursor: pointer;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%23E93B81'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 16px center;
            background-size: 20px;
            padding-right: 48px;
        }

        .form-input::-ms-reveal,
        .form-input::-ms-clear {
            display: none;
        }

        .form-input::placeholder {
            color: #643843;
        }

        .form-input:focus, .form-select:focus {
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

        .login-link-section {
            text-align: center;
            margin-top: 16px;
        }

        .login-link {
            color: white;
            text-decoration: none;
            font-size: 14px;
            transition: color 0.3s;
            font-weight: 550;
        }

        .login-link:hover {
            color: #FFE5E2;
        }

        .submit-btn {
            font-family: 'Mulish', sans-serif;
            margin-top: 20px;
            width: 100%;
            padding: 14px 24px;
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

    <!-- Register Card -->
    <div class="login-container">
        <div class="login-card">
            <!-- Background blur -->
            <div class="bg-blur"></div>
            <div class="overlay"></div>

            <!-- Content -->
            <div class="content">
                <!-- Tab Navigation -->
                <div class="tabs">
                    <a href="{{ route('login') }}" class="tab tab-inactive">
                        <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                        </svg>
                        Masuk
                    </a>
                    <button class="tab tab-active">
                        <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                        </svg>
                        Daftar
                    </button>
                </div>

                <!-- Welcome Text -->
                <div class="welcome-section">
                    <h1 class="welcome-title">Buat Akun</h1>
                    <p class="welcome-subtitle">Daftar Untuk Memulai</p>
                </div>

                <!-- Register Form -->
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- Name -->
                    <div class="form-group">
                        <div class="input-wrapper">
                            <div class="input-icon">
                                <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                            <input id="name"
                                   type="text"
                                   name="name"
                                   value="{{ old('name') }}"
                                   required
                                   autofocus
                                   placeholder="Nama Lengkap"
                                   class="form-input"/>
                        </div>
                        @error('name')
                        <p class="error-message">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Username -->
                    <div class="form-group">
                        <div class="input-wrapper">
                            <div class="input-icon">
                                <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <input id="username"
                               type="text"
                               name="username"
                               value="{{ old('username') }}"
                               required
                               placeholder="Nama Pengguna"
                               class="form-input"/>
                    </div>
                    @error('username')
                    <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
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
                               placeholder="Alamat Email"
                               class="form-input"/>
                    </div>
                    @error('email')
                    <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Gender & Phone Row -->
                <div class="form-row">
                    <!-- Gender -->
                    <div class="form-group">
                        <div class="input-wrapper">
                            <div class="input-icon">
                                <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                                </svg>
                            </div>
                            <select id="gender"
                                    name="gender"
                                    required
                                    class="form-select">
                                <option value="">Jenis Kelamin</option>
                                <option value="wanita" {{ old('gender') == 'wanita' ? 'selected' : '' }}>Wanita</option>
                                <option value="pria" {{ old('gender') == 'pria' ? 'selected' : '' }}>Pria</option>
                            </select>
                        </div>
                        @error('gender')
                        <p class="error-message">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Phone Number -->
                    <div class="form-group">
                        <div class="input-wrapper">
                            <div class="input-icon">
                                <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                        </div>
                        <input id="phone_number"
                               type="text"
                               name="phone_number"
                               value="{{ old('phone_number') }}"
                               placeholder="No.Telp (Opsional)"
                               class="form-input"/>
                    </div>
                    @error('phone_number')
                    <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Password & Confirm Password Row -->
            <div class="form-row">
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
                               autocomplete="new-password"
                               placeholder="Kata Sandi"
                               class="form-input"/>
                        <button type="button"
                                onclick="togglePassword('password', 'eye-icon-1')"
                                class="password-toggle">
                            <svg id="eye-icon-1" class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </button>
                    </div>
                    @error('password')
                    <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="form-group">
                    <div class="input-wrapper">
                        <div class="input-icon">
                            <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                            </svg>
                        </div>
                        <input id="password_confirmation"
                               type="password"
                               name="password_confirmation"
                               required
                               autocomplete="new-password"
                               placeholder="Konfir Kata Sandi"
                               class="form-input"/>
                        <button type="button"
                                onclick="togglePassword('password_confirmation', 'eye-icon-2')"
                                class="password-toggle">
                            <svg id="eye-icon-2" class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </button>
                    </div>
                    @error('password_confirmation')
                    <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>
            </div>

                    <!-- Register Button -->
                    <button type="submit" class="submit-btn">
                        Daftar
                    </button>

                    <!-- Login Link -->
                    <div class="login-link-section">
                        <a href="{{ route('login') }}" class="login-link">
                            Sudah Memiliki Akun? Masuk
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function togglePassword(inputId, iconId) {
            const passwordInput = document.getElementById(inputId);
            const eyeIcon = document.getElementById(iconId);
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />';
            } else {
                passwordInput.type = 'password';
                eyeIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />';
            }
        }
    </script>
</body>
</html>
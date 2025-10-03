<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Import font dari Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@400;600;700&family=Dancing+Script&display=swap" rel="stylesheet">
    <!-- Sweet Alert 2 untuk notifikasi popup -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.10.5/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.10.5/sweetalert2.min.css">
    <title>Login</title>
    <style>
        /* Reset default styling dari browser */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Styling untuk body halaman */
        body {
            font-family: 'Mulish', sans-serif;
            background: linear-gradient(125deg, rgba(233, 59, 129, 0.1), rgba(233, 59, 129, 0.1));
            background-size: cover;
            background-position: center;
            min-height: 100vh; /* Tinggi minimum 100% viewport */
            display: flex;
            align-items: center; /* Posisikan konten di tengah vertikal */
            justify-content: center; /* Posisikan konten di tengah horizontal */
            padding: 20px;
            position: relative;
            overflow: hidden; /* Sembunyikan overflow */
        }

        /* Container untuk efek blur background */
        .latar-blur {
            position: fixed;
            inset: 0; /* Top, right, bottom, left = 0 */
            pointer-events: none; /* Tidak menghalangi interaksi mouse */
            overflow: hidden;
        }

        /* Lingkaran blur untuk efek dekorasi */
        .lingkaran-blur {
            position: absolute;
            width: 384px;
            height: 384px;
            background: rgba(233, 59, 129, 0.09); /* Pink transparan */
            border-radius: 50%; /* Bentuk lingkaran */
            filter: blur(96px); /* Efek blur kuat */
        }

        /* Lingkaran blur pertama di pojok kiri atas */
        .lingkaran-blur:first-child {
            top: -192px;
            left: -192px;
        }

        /* Lingkaran blur kedua di pojok kanan bawah */
        .lingkaran-blur:last-child {
            bottom: -192px;
            right: -192px;
        }

        /* Container utama untuk form login */
        .wadah-login {
            position: relative;
            width: 100%;
            max-width: 500px; /* Maksimal lebar 500px */
            z-index: 1; /* Layer di atas background blur */
        }

        /* Card/kotak login */
        .kartu-login {
            position: relative;
            border-radius: 24px; /* Sudut membulat */
            overflow: hidden;
            box-shadow: 0 25px 50px -12px rgba(0,0,0,0.5); /* Bayangan card */
            min-height: 620px;
        }

        /* Background blur untuk card login */
        .kartu-login .latar-blur {
            position: absolute;
            inset: 0;
            background: url('images/gambar.jpg') center/cover no-repeat;
            filter: blur(15px); /* Efek blur pada background image */
            transform: scale(1.1); /* Perbesar sedikit agar blur tidak kelihatan pinggirnya */
            z-index: 1;
        }

        /* Overlay pink transparan di atas background */
        .kartu-login .lapisan-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(125deg, rgba(233,59,129,0.2), rgba(233,59,129,0.2));
            z-index: 2; /* Layer di atas background blur */
        }

        /* Container untuk konten form */
        .kartu-login .konten {
            position: relative;
            z-index: 3; /* Layer paling atas */
            padding: 40px;
        }

        /* Container untuk tab navigasi (Masuk/Daftar) */
        .tab-navigasi {
            display: flex;
            gap: 16px; /* Jarak antar tab */
            margin-bottom: 35px;
        }

        /* Styling untuk setiap tab */
        .tab {
            font-family: 'Mulish', sans-serif;
            flex: 1; /* Bagi ruang secara merata */
            padding: 12px 24px;
            border-radius: 12px;
            font-weight: bold;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px; /* Jarak antara icon dan teks */
            transition: all 0.3s; /* Animasi smooth */
            text-decoration: none;
            border: none;
            cursor: pointer;
            font-size: 16px;
            font-weight: 600;
        }

        /* Tab yang sedang aktif */
        .tab-aktif {
            background: #FFE5E2; /* Background pink muda */
            color: #643843; /* Teks coklat gelap */
            box-shadow: 0 10px 25px rgba(233, 59, 129, 0.3); /* Bayangan pink */
        }

        /* Tab yang tidak aktif */
        .tab-nonaktif {
            background: rgba(255, 255, 255, 0.05); /* Background putih transparan */
            color: white;
        }

        /* Efek hover pada tab tidak aktif */
        .tab-nonaktif:hover {
            background: rgba(255, 255, 255, 0.4); /* Background lebih terang */
        }

        /* Section untuk teks selamat datang */
        .bagian-selamat-datang {
            text-align: center;
            margin-bottom: 32px;
        }

        /* Judul utama "Halo, Selamat Datang!" */
        .judul-selamat-datang {
            font-size: 36px;
            font-weight: 900;
            color: white;
            margin-bottom: 8px;
        }

        /* Subjudul "Masuk Ke Akun Anda" */
        .subjudul-selamat-datang {
            color: white;
            font-size: 16px;
            font-weight: 500;
            margin-bottom: 60px;
        }

        /* Group untuk setiap input field */
        .grup-form {
            margin-bottom: 18px;
        }

        /* Wrapper untuk input dengan icon */
        .pembungkus-input {
            position: relative;
        }

        /* Icon di dalam input field */
        .ikon-input {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%); /* Posisikan tepat di tengah vertikal */
            color: #E93B81; /* Warna pink */
            pointer-events: none; /* Tidak bisa diklik */
        }

        /* Styling untuk input field */
        .input-form {
            font-family: 'Mulish', sans-serif;
            width: 100%;
            padding: 16px 16px 16px 48px; /* Padding kiri lebih besar untuk icon */
            background: rgba(255, 255, 255, 0.5); /* Background putih transparan */
            border: 1px solid rgba(233, 59, 129, 0.3); /* Border pink transparan */
            border-radius: 12px;
            color: #643843; /* Warna teks coklat gelap */
            font-size: 13px;
            font-weight: 600;
            transition: all 0.3s;
        }

        /* Sembunyikan tombol show/hide password bawaan browser */
        .input-form::-ms-reveal,
        .input-form::-ms-clear {
            display: none;
        }

        .input-form::-webkit-credentials-auto-fill-button,
        .input-form::-webkit-contacts-auto-fill-button {
            visibility: hidden;
            pointer-events: none;
            position: absolute;
        }

        /* Styling untuk placeholder text */
        .input-form::placeholder {
            color: #643843;
        }

        /* Efek saat input field di-focus */
        .input-form:focus {
            outline: none;
            border-color: rgba(233, 59, 129, 0.3);
            box-shadow: 0 0 0 3px rgba(233, 59, 129, 0.3); /* Ring effect */
        }

        /* Tombol toggle show/hide password */
        .tombol-toggle-password {
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

        .tombol-toggle-password:hover {
            color: #E93B81;
        }

        /* Pesan error validasi */
        .pesan-error {
            margin-top: 8px;
            color: #f87171; /* Merah muda */
            font-size: 14px;
        }

        /* Container untuk checkbox "Ingat Saya" dan link "Lupa Password" */
        .ingat-lupa {
            display: flex;
            align-items: center;
            justify-content: space-between; /* Pisahkan ke kiri dan kanan */
            margin-bottom: 24px;
        }

        /* Label untuk checkbox "Ingat Saya" */
        .label-ingat {
            display: flex;
            align-items: center;
            cursor: pointer;
            color: white;
            font-size: 14px;
            font-weight: 550;
        }

        /* Checkbox "Ingat Saya" */
        .checkbox-ingat {
            width: 16px;
            height: 16px;
            margin-left: 5px;
            margin-right: 8px;
            border-radius: 4px;
            border: 1px solid #E93B81;
            cursor: pointer;
            accent-color: #e93b81; /* Warna checkbox saat dicentang */
        }

        /* Link "Lupa Kata Sandi" */
        .link-lupa {
            color: white;
            text-decoration: none;
            font-size: 14px;
            transition: color 0.3s;
            font-weight: 550;
            margin-right: 5px;
        }

        /* Tombol submit "Masuk" */
        .tombol-submit {
            font-family: 'Mulish', sans-serif;
            margin-top: 50px;
            width: 100%;
            padding: 16px 24px;
            border-radius: 12px;
            background: #FFE5E2; /* Background pink muda */
            color: #643843; /* Teks coklat gelap */
            font-weight: 900;
            font-size: 16px;
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            box-shadow: 0 10px 25px rgba(233, 59, 129, 0.3); /* Bayangan pink */
            transition: all 0.3s;
        }

        /* Efek hover pada tombol submit */
        .tombol-submit:hover {
            background: #ffe5e2ff;
            box-shadow: 0 10px 25px rgba(233, 59, 129, 0.6); /* Bayangan lebih kuat */
            transform: scale(1.02); /* Perbesar sedikit */
        }

        /* Styling untuk icon SVG */
        .ikon {
            width: 20px;
            height: 20px;
        }

        svg {
            display: block;
        }

        /* Tombol kembali di pojok kiri atas */
        .tombol-kembali {
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

        .tombol-kembali svg {
            width: 28px;
            height: 28px;
            stroke: #E93B81; /* Warna pink */
        }

        /* Custom styling untuk Sweet Alert popup */
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
    
    <!-- Tombol Kembali ke halaman sebelumnya -->
    <a href="{{ route('landing') }}" class="tombol-kembali">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
        </svg>
    </a>

    <!-- Background blur effects untuk dekorasi -->
    <div class="latar-blur">
        <div class="lingkaran-blur"></div>
        <div class="lingkaran-blur"></div>
    </div>

    <!-- Container Card Login -->
    <div class="wadah-login">
        <div class="kartu-login">
            <!-- Background blur dengan gambar -->
            <div class="latar-blur"></div>
            <!-- Overlay pink transparan -->
            <div class="lapisan-overlay"></div>

            <!-- Konten Form Login -->
            <div class="konten">
                <!-- Tab Navigasi: Masuk & Daftar -->
                <div class="tab-navigasi">
                    <!-- Tab Masuk (Aktif) -->
                    <button class="tab tab-aktif">
                        <svg class="ikon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                        </svg>
                        Masuk
                    </button>
                    <!-- Tab Daftar (Tidak Aktif) -->
                    <a href="{{ route('register') }}" class="tab tab-nonaktif">
                        <svg class="ikon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                        </svg>
                        Daftar
                    </a>
                </div>

                <!-- Bagian Teks Selamat Datang -->
                <div class="bagian-selamat-datang">
                    <h1 class="judul-selamat-datang">Halo, Selamat Datang!</h1>
                    <p class="subjudul-selamat-datang">Masuk Ke Akun Anda</p>
                </div>

                <!-- Form Login -->
                <form method="POST" action="{{ route('login') }}" id="formLogin">
                    @csrf

                    <!-- Input Email -->
                    <div class="grup-form">
                        <div class="pembungkus-input">
                            <!-- Icon Email -->
                            <div class="ikon-input">
                                <svg class="ikon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <!-- Field Input Email -->
                            <input id="email"
                                   type="email"
                                   name="email"
                                   value="{{ old('email') }}"
                                   required
                                   autofocus
                                   autocomplete="username"
                                   placeholder="Alamat Email"
                                   class="input-form"/>
                        </div>
                    </div>

                    <!-- Input Password -->
                    <div class="grup-form">
                        <div class="pembungkus-input">
                            <!-- Icon Password -->
                            <div class="ikon-input">
                                <svg class="ikon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                </svg>
                            </div>
                            <!-- Field Input Password -->
                            <input id="password"
                                   type="password"
                                   name="password"
                                   required
                                   autocomplete="current-password"
                                   placeholder="Kata Sandi"
                                   class="input-form"/>
                            <!-- Tombol Toggle Show/Hide Password -->
                            <button type="button"
                                    onclick="togglePassword()"
                                    class="tombol-toggle-password">
                                <svg id="ikon-mata" class="ikon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Checkbox Ingat Saya & Link Lupa Password -->
                    <div class="ingat-lupa">
                        <!-- Checkbox Ingat Saya -->
                        <label for="ingat_saya" class="label-ingat">
                            <input id="ingat_saya"
                                   type="checkbox"
                                   name="remember"
                                   class="checkbox-ingat"/>
                            Ingat Saya
                        </label>

                        <!-- Link Lupa Kata Sandi -->
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="link-lupa">
                                Lupa Kata Sandi?
                            </a>
                        @endif
                    </div>

                    <!-- Tombol Submit Masuk -->
                    <button type="submit" class="tombol-submit">
                        Masuk
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Fungsi untuk toggle show/hide password
        function togglePassword() {
            const inputPassword = document.getElementById('password');
            const ikonMata = document.getElementById('ikon-mata');
            
            // Cek tipe input saat ini
            if (inputPassword.type === 'password') {
                // Ubah ke text (password terlihat)
                inputPassword.type = 'text';
                // Ganti icon menjadi mata tercoret
                ikonMata.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />';
            } else {
                // Ubah ke password (password tersembunyi)
                inputPassword.type = 'password';
                // Ganti icon menjadi mata normal
                ikonMata.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />';
            }
        }

        // Tampilkan Sweet Alert jika ada error validasi dari Laravel
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
        document.getElementById('formLogin').addEventListener('submit', function(e) {
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;

            // Validasi apakah input kosong
            if (!email || !password) {
                e.preventDefault(); // Cegah form submit
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
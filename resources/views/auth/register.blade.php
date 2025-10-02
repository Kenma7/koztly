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
    <title>Register</title>
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

        /* Container utama untuk form register */
        .wadah-register {
            position: relative;
            width: 100%;
            max-width: 500px; /* Maksimal lebar 500px */
            z-index: 1; /* Layer di atas background blur */
        }

        /* Card/kotak register */
        .kartu-register {
            position: relative;
            border-radius: 24px; /* Sudut membulat */
            overflow: hidden;
            box-shadow: 0 25px 50px -12px rgba(0,0,0,0.5); /* Bayangan card */
            min-height: 620px;
        }

        /* Background blur untuk card register */
        .kartu-register .latar-blur {
            position: absolute;
            inset: 0;
            background: url('images/gambar.jpg') center/cover no-repeat;
            filter: blur(15px); /* Efek blur pada background image */
            transform: scale(1.1); /* Perbesar sedikit agar blur tidak kelihatan pinggirnya */
            z-index: 1;
        }

        /* Overlay pink transparan di atas background */
        .kartu-register .lapisan-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(125deg, rgba(233,59,129,0.2), rgba(233,59,129,0.2));
            z-index: 2; /* Layer di atas background blur */
        }

        /* Container untuk konten form */
        .kartu-register .konten {
            position: relative;
            z-index: 3; /* Layer paling atas */
            padding: 40px;
        }

        /* Container untuk tab navigasi (Masuk/Daftar) */
        .tab-navigasi {
            display: flex;
            gap: 16px; /* Jarak antar tab */
            margin-bottom: 28px;
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
            margin-bottom: 24px;
        }

        /* Judul utama "Buat Akun" */
        .judul-selamat-datang {
            font-size: 32px;
            font-weight: 900;
            color: white;
            margin-bottom: 4px;
        }

        /* Subjudul "Daftar Untuk Memulai" */
        .subjudul-selamat-datang {
            color: white;
            font-size: 15px;
            font-weight: 500;
            margin-bottom: 32px;
        }

        /* Group untuk setiap input field */
        .grup-form {
            margin-bottom: 12px;
        }

        /* Row untuk input berdampingan (2 kolom) */
        .baris-form {
            display: grid;
            grid-template-columns: 1fr 1fr; /* 2 kolom sama besar */
            gap: 12px; /* Jarak antar kolom */
            margin-bottom: 12px;
        }

        /* Hapus margin bottom pada form group di dalam row */
        .baris-form .grup-form {
            margin-bottom: 0;
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

        /* Styling untuk input field dan select dropdown */
        .input-form, .pilihan-form {
            font-family: 'Mulish', sans-serif;
            width: 100%;
            padding: 14px 16px 14px 48px; /* Padding kiri lebih besar untuk icon */
            background: rgba(255, 255, 255, 0.5); /* Background putih transparan */
            border: 1px solid rgba(233, 59, 129, 0.3); /* Border pink transparan */
            border-radius: 12px;
            color: #643843; /* Warna teks coklat gelap */
            font-size: 13px;
            font-weight: 600;
            transition: all 0.3s;
        }

        /* Styling khusus untuk select dropdown */
        .pilihan-form {
            cursor: pointer;
            appearance: none; /* Hilangkan arrow default browser */
            /* Custom arrow dropdown dengan SVG */
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%23E93B81'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 16px center;
            background-size: 20px;
            padding-right: 48px; /* Ruang untuk arrow */
        }

        /* Sembunyikan tombol show/hide password bawaan browser */
        .input-form::-ms-reveal,
        .input-form::-ms-clear {
            display: none;
        }

        /* Styling untuk placeholder text */
        .input-form::placeholder {
            color: #643843;
        }

        /* Efek saat input field atau select di-focus */
        .input-form:focus, .pilihan-form:focus {
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

        /* Tombol submit "Daftar" */
        .tombol-submit {
            font-family: 'Mulish', sans-serif;
            margin-top: 20px;
            width: 100%;
            padding: 14px 24px;
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

        .swal2-html-container {
            font-size: 16px !important;
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

    <!-- Container Card Register -->
    <div class="wadah-register">
        <div class="kartu-register">
            <!-- Background blur dengan gambar -->
            <div class="latar-blur"></div>
            <!-- Overlay pink transparan -->
            <div class="lapisan-overlay"></div>

            <!-- Konten Form Register -->
            <div class="konten">
                <!-- Tab Navigasi: Masuk & Daftar -->
                <div class="tab-navigasi">
                    <!-- Tab Masuk (Tidak Aktif) -->
                    <a href="{{ route('login') }}" class="tab tab-nonaktif">
                        <svg class="ikon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                        </svg>
                        Masuk
                    </a>
                    <!-- Tab Daftar (Aktif) -->
                    <button class="tab tab-aktif">
                        <svg class="ikon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                        </svg>
                        Daftar
                    </button>
                </div>

                <!-- Bagian Teks Selamat Datang -->
                <div class="bagian-selamat-datang">
                    <h1 class="judul-selamat-datang">Buat Akun</h1>
                    <p class="subjudul-selamat-datang">Daftar Untuk Memulai</p>
                </div>

                <!-- Form Register -->
                <form method="POST" action="{{ route('register') }}" id="formRegister">
                    @csrf

                    <!-- Input Nama Lengkap -->
                    <div class="grup-form">
                        <div class="pembungkus-input">
                            <!-- Icon User -->
                            <div class="ikon-input">
                                <svg class="ikon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                            <!-- Field Input Nama -->
                            <input id="nama"
                                   type="text"
                                   name="name"
                                   value="{{ old('name') }}"
                                   required
                                   autofocus
                                   placeholder="Nama Lengkap"
                                   class="input-form"/>
                        </div>
                    </div>

                    <!-- Input Username -->
                    <div class="grup-form">
                        <div class="pembungkus-input">
                            <!-- Icon Username -->
                            <div class="ikon-input">
                                <svg class="ikon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <!-- Field Input Username -->
                            <input id="username"
                                   type="text"
                                   name="username"
                                   value="{{ old('username') }}"
                                   required
                                   placeholder="Nama Pengguna"
                                   class="input-form"/>
                        </div>
                    </div>

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
                                   placeholder="Alamat Email"
                                   class="input-form"/>
                        </div>
                    </div>

                    <!-- Row untuk Jenis Kelamin & No. Telepon -->
                    <div class="baris-form">
                        <!-- Input Jenis Kelamin -->
                        <div class="grup-form">
                            <div class="pembungkus-input">
                                <!-- Icon Gender -->
                                <div class="ikon-input">
                                    <svg class="ikon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                                    </svg>
                                </div>
                                <!-- Dropdown Jenis Kelamin -->
                                <select id="jenis_kelamin"
                                        name="gender"
                                        required
                                        class="pilihan-form">
                                    <option value="">Jenis Kelamin</option>
                                    <option value="wanita" {{ old('gender') == 'wanita' ? 'selected' : '' }}>Wanita</option>
                                    <option value="pria" {{ old('gender') == 'pria' ? 'selected' : '' }}>Pria</option>
                                </select>
                            </div>
                        </div>

                        <!-- Input No. Telepon (Opsional) -->
                        <div class="grup-form">
                            <div class="pembungkus-input">
                                <!-- Icon Phone -->
                                <div class="ikon-input">
                                    <svg class="ikon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                    </svg>
                                </div>
                                <!-- Field Input No. Telepon -->
                                <input id="nomor_telepon"
                                       type="text"
                                       name="phone_number"
                                       value="{{ old('phone_number') }}"
                                       placeholder="No.Telp (Opsional)"
                                       class="input-form"/>
                            </div>
                        </div>
                    </div>

                    <!-- Row untuk Password & Konfirmasi Password -->
                    <div class="baris-form">
                        <!-- Input Password -->
                        <div class="grup-form">
                            <div class="pembungkus-input">
                                <!-- Icon Lock -->
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
                                       autocomplete="new-password"
                                       placeholder="Kata Sandi"
                                       class="input-form"/>
                                <!-- Tombol Toggle Show/Hide Password -->
                                <button type="button"
                                        onclick="togglePassword('password', 'ikon-mata-1')"
                                        class="tombol-toggle-password">
                                    <svg id="ikon-mata-1" class="ikon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <!-- Input Konfirmasi Password -->
                        <div class="grup-form">
                            <div class="pembungkus-input">
                                <!-- Icon Shield Check -->
                                <div class="ikon-input">
                                    <svg class="ikon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                    </svg>
                                </div>
                                <!-- Field Input Konfirmasi Password -->
                                <input id="konfirmasi_password"
                                       type="password"
                                       name="password_confirmation"
                                       required
                                       autocomplete="new-password"
                                       placeholder="Konfir Kata Sandi"
                                       class="input-form"/>
                                <!-- Tombol Toggle Show/Hide Password -->
                                <button type="button"
                                        onclick="togglePassword('konfirmasi_password', 'ikon-mata-2')"
                                        class="tombol-toggle-password">
                                    <svg id="ikon-mata-2" class="ikon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Tombol Submit Daftar -->
                    <button type="submit" class="tombol-submit">
                        Daftar
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Fungsi untuk toggle show/hide password
        function togglePassword(idInput, idIkon) {
            const inputPassword = document.getElementById(idInput);
            const ikonMata = document.getElementById(idIkon);
            
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

        // Validasi client-side untuk password sebelum form di-submit
        document.getElementById('formRegister').addEventListener('submit', function(e) {
            const password = document.getElementById('password').value;
            const konfirmasiPassword = document.getElementById('konfirmasi_password').value;

            // Validasi 1: Cek panjang password minimal 8 karakter
            if (password.length < 8) {
                e.preventDefault(); // Cegah form submit
                Swal.fire({
                    icon: 'warning',
                    title: 'Password Terlalu Pendek',
                    html: '<p style="font-size: 15px; color: #643843;">Password harus minimal <strong>8 karakter</strong>.</p>',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#E93B81'
                });
                return;
            }

            // Validasi 2: Cek kombinasi huruf dan angka
            const adaHuruf = /[a-zA-Z]/.test(password); // Cek ada huruf
            const adaAngka = /[0-9]/.test(password); // Cek ada angka

            if (!adaHuruf || !adaAngka) {
                e.preventDefault(); // Cegah form submit
                Swal.fire({
                    icon: 'warning',
                    title: 'Password Tidak Valid',
                    html: '<p style="font-size: 15px; color: #643843;">Password harus mengandung kombinasi <strong>huruf</strong> dan <strong>angka</strong>.</p><p style="font-size: 14px; color: #E93B81; margin-top: 8px;">Contoh: Password123</p>',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#E93B81'
                });
                return;
            }

            // Validasi 3: Cek apakah password dan konfirmasi cocok
            if (password !== konfirmasiPassword) {
                e.preventDefault(); // Cegah form submit
                Swal.fire({
                    icon: 'error',
                    title: 'Password Tidak Cocok',
                    text: 'Password dan konfirmasi password harus sama. Silakan periksa kembali.',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#E93B81'
                });
                return;
            }
        });

        // Tampilkan Sweet Alert untuk error dan success dari Laravel
        document.addEventListener('DOMContentLoaded', function() {
            // Error handling - Tampilkan pesan error sesuai jenis kesalahan
            @if ($errors->any())
                @if ($errors->has('email'))
                    // Error: Email sudah terdaftar
                    Swal.fire({
                        icon: 'error',
                        title: 'Email Sudah Terdaftar',
                        text: 'Email yang Anda masukkan sudah digunakan. Silakan gunakan email lain atau login dengan email tersebut.',
                        confirmButtonText: 'OK',
                        confirmButtonColor: '#E93B81'
                    });
                @elseif ($errors->has('username'))
                    // Error: Username sudah digunakan
                    Swal.fire({
                        icon: 'error',
                        title: 'Username Sudah Digunakan',
                        text: 'Username yang Anda pilih sudah digunakan. Silakan pilih username lain.',
                        confirmButtonText: 'OK',
                        confirmButtonColor: '#E93B81'
                    });
                @elseif ($errors->has('password'))
                    // Error: Password tidak memenuhi kriteria
                    Swal.fire({
                        icon: 'error',
                        title: 'Password Tidak Valid',
                        text: '{{ $errors->first('password') }}',
                        confirmButtonText: 'OK',
                        confirmButtonColor: '#E93B81'
                    });
                @else
                    // Error: Kesalahan umum
                    Swal.fire({
                        icon: 'error',
                        title: 'Terjadi Kesalahan',
                        text: 'Silakan periksa kembali data yang Anda masukkan.',
                        confirmButtonText: 'OK',
                        confirmButtonColor: '#E93B81'
                    });
                @endif
            @endif

            // Success notification - Redirect ke halaman login setelah registrasi berhasil
            @if (session('registered'))
                Swal.fire({
                    icon: 'success',
                    title: 'Registrasi Berhasil!',
                    html: '<p style="margin-bottom: 10px; font-size: 15px; color: #643843;">Akun Anda berhasil didaftarkan.</p><p style="font-weight: 600; font-size: 15px; color: #E93B81;">Silakan masuk menggunakan akun yang sudah Anda daftarkan.</p>',
                    confirmButtonText: 'Masuk',
                    confirmButtonColor: '#E93B81',
                    allowOutsideClick: false, // Tidak bisa klik di luar popup
                    allowEscapeKey: false // Tidak bisa tekan ESC untuk close
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Redirect ke halaman login setelah klik tombol "Masuk"
                        window.location.href = "{{ route('login') }}";
                    }
                });
            @endif
        });
    </script>
</body>
</html>
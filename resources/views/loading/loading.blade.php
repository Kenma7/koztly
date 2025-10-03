<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Koztly - Memuat</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Styling untuk body halaman */
        body {
            overflow: hidden; /* Sembunyikan scrollbar */
            background: #FFE5E2; /* Warna background pink muda */
        }

        /* Kontainer utama untuk animasi loading */
        .wadah-memuat {
            width: 100vw; /* Lebar penuh viewport */
            height: 100vh; /* Tinggi penuh viewport */
            display: flex;
            align-items: center; /* Posisikan konten di tengah vertikal */
            justify-content: center; /* Posisikan konten di tengah horizontal */
            position: relative;
            overflow: hidden;
        }

        /* Wrapper untuk kedua logo */
        .pembungkus-logo {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer; /* Ubah kursor jadi pointer saat hover */
            transition: transform 0.3s ease; /* Animasi smooth saat hover */
        }

        /* Efek zoom saat hover pada logo */
        .pembungkus-logo:hover {
            transform: scale(1.05); /* Perbesar 5% */
        }

        /* Logo K yang muncul pertama kali */
        .logo-k {
            width: 160px;
            height: 160px;
            opacity: 0; /* Mulai tidak terlihat */
            transform: translateY(100px); /* Mulai dari bawah */
            /* Animasi 1: Muncul dari bawah, Animasi 2: Geser ke kiri */
            animation: munculDariBawah 1s ease-out 0.5s forwards,
                geserKeKiri 0.8s ease-out 2s forwards;
            z-index: 2; /* Layer di atas logo koztly */
        }

        /* Logo Koztly lengkap yang muncul setelah logo K */
        .logo-koztly {
            width: 170px;
            height: 170px;
            position: absolute;
            opacity: 0; /* Mulai tidak terlihat */
            transform: translateX(-30px); /* Mulai dari posisi K setelah bergeser */
            /* Animasi: Muncul dari posisi K */
            animation: munculDariK 1s ease-out 3s forwards;
            z-index: 1; /* Layer di bawah logo K */
        }

        /* Lingkaran putih yang membesar untuk transisi ke halaman landing */
        .lingkaran-membesar {
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            background: white; /* Warna putih */
            border-radius: 50%; /* Bentuk lingkaran */
            transform: translate(-50%, -50%); /* Posisikan di tengah */
            z-index: 10; /* Layer paling atas */
            animation: membesarkanLingkaran 1.5s ease-out 5s forwards;
        }

        /* Animasi: Logo K muncul dari bawah dengan fade in */
        @keyframes munculDariBawah {
            0% {
                opacity: 0;
                transform: translateY(100px); /* Mulai 100px di bawah */
            }
            100% {
                opacity: 1;
                transform: translateY(0); /* Posisi normal */
            }
        }

        /* Animasi: Logo K bergeser ke kiri */
        @keyframes geserKeKiri {
            0% {
                transform: translateY(0) translateX(0);
            }
            100% {
                transform: translateY(0) translateX(-70px); /* Geser 70px ke kiri */
            }
        }

        /* Animasi: Logo Koztly muncul dari posisi K dengan slide */
        @keyframes munculDariK {
            0% {
                opacity: 0;
                transform: translateX(-50px);
            }
            100% {
                opacity: 1;
                transform: translateX(70px); /* Geser 70px ke kanan */
            }
        }

        /* Animasi: Lingkaran putih membesar untuk transisi */
        @keyframes membesarkanLingkaran {
            0% {
                width: 0;
                height: 0;
                opacity: 1;
            }
            50% {
                opacity: 1;
            }
            100% {
                width: 300vw; /* 3x lebar viewport */
                height: 300vw; /* 3x lebar viewport */
                opacity: 1;
            }
        }

        /* Animasi untuk menampilkan halaman landing */
        @keyframes tampilkanHalamanLanding {
            to {
                opacity: 1;
            }
        }
    </style>
</head>

<body>
    <!-- Kontainer utama untuk animasi loading -->
    <div class="wadah-memuat">
        <!-- Pembungkus logo yang bisa diklik untuk skip animasi -->
        <div class="pembungkus-logo" onclick="lonkatKeHalamanLanding()">
            <!-- Logo K -->
            <div class="logo-k">
                <img src="images/k.png" alt="Logo K" style="width: 100%; height: 100%; object-fit: contain;">
            </div>

            <!-- Logo Koztly lengkap -->
            <div class="logo-koztly">
                <img src="images/koztly.png" alt="Logo Koztly" style="width: 100%; height: 100%; object-fit: contain;">
            </div>
        </div>

        <!-- Lingkaran putih untuk efek transisi -->
        <div class="lingkaran-membesar"></div>
    </div>

    <script>
        // Mencegah scroll pada halaman
        document.body.style.overflow = 'hidden';

        // Variabel untuk cek apakah animasi sudah selesai
        let animasiSelesai = false;

        // Fungsi untuk loncat ke halaman landing
        function lonkatKeHalamanLanding() {
            // Cek apakah logo koztly sudah muncul sebelum allow skip
            if (!animasiSelesai && document.querySelector('.logo-koztly').style.opacity !== '0') {
                window.location.href = 'landing';
            }
        }

        // Redirect otomatis ke halaman landing setelah 5.5 detik
        setTimeout(() => {
            if (!animasiSelesai) {
                window.location.href = 'landing';
            }
        }, 5500);

        // Event listener untuk tombol CTA (jika ada)
        const tombolCta = document.querySelector('.tombol-cta');
        if (tombolCta) {
            tombolCta.addEventListener('click', function () {
                window.location.href = 'landing';
            });
        }

        // Fungsi untuk membuat partikel animasi
        function buatPartikel() {
            const partikel = document.createElement('div');
            // Styling untuk partikel
            partikel.style.cssText = `
                position: absolute;
                width: 4px;
                height: 4px;
                background: rgba(255,255,255,0.6); /* Putih semi-transparan */
                border-radius: 50%; /* Bentuk bulat */
                pointer-events: none; /* Tidak menghalangi klik */
                animation: melayang 3s linear infinite;
            `;

            // Posisi random horizontal
            partikel.style.left = Math.random() * window.innerWidth + 'px';
            // Mulai dari bawah layar
            partikel.style.top = window.innerHeight + 'px';

            document.body.appendChild(partikel);

            // Hapus partikel setelah 1 detik untuk performa
            setTimeout(() => {
                partikel.remove();
            }, 1000);
        }

        // Mulai buat partikel setelah 1 detik
        setTimeout(() => {
            setInterval(buatPartikel, 500); // Buat partikel setiap 0.5 detik
        }, 1000);

        // Tambahkan animasi melayang untuk partikel secara dinamis
        const gaya = document.createElement('style');
        gaya.textContent = `
            @keyframes melayang {
                to {
                    /* Partikel naik ke atas sambil berputar */
                    transform: translateY(-${window.innerHeight + 50}px) rotate(360deg);
                    opacity: 0; /* Fade out */
                }
            }
        `;
        document.head.appendChild(gaya);
    </script>
</body>

</html>
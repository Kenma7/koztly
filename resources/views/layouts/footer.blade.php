<footer class="relative z-20 bg-pink-50 border-t border-pink-200 text-pink-700 py-10">
    <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-4 gap-8">
        <!-- Kolom 1: Logo & Deskripsi -->
        <div>
            <div class="flex items-center space-x-2 mb-3">
                <img src="{{ asset('images/logo.png') }}" alt="Kozatly Logo" class="h-7 w-auto">
            </div>
            <p class="text-sm text-pink-700 leading-relaxed">
                Platform pencarian kos terpercaya yang membantu kamu menemukan hunian nyaman dan sesuai kebutuhan dengan
                mudah.
            </p>
            <div class="flex space-x-3 mt-4">
                <a href="#"
                    class="bg-[#d12670] text-white w-8 h-8 flex items-center justify-center rounded-full hover:bg-[#ea3882] transition">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="#"
                    class="bg-[#d12670] text-white w-8 h-8 flex items-center justify-center rounded-full hover:bg-[#ea3882] transition">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="#"
                    class="bg-[#d12670] text-white w-8 h-8 flex items-center justify-center rounded-full hover:bg-[#ea3882] transition">
                    <i class="fab fa-linkedin-in"></i>
                </a>
            </div>
        </div>

        <!-- Kolom 2: Navigasi -->
        <div>
            <h3 class="text-lg font-semibold text-[#d12670] mb-3">Navigasi</h3>
            <ul class="space-y-2 text-sm">
                <li><a href="/" class="hover:text-[#ea3882] transition">Home</a></li>
                <li><a href="/tentang" class="hover:text-[#ea3882] transition">Tentang</a></li>
                <li><a href="/kontak" class="hover:text-[#ea3882] transition">Kontak</a></li>
            </ul>
        </div>

        <!-- Kolom 3: Link Cepat -->
        <div>
            <h3 class="text-lg font-semibold text-[#d12670] mb-3">Link Cepat</h3>
            <ul class="space-y-2 text-sm">
                <li><a href="/hubungi" class="hover:text-[#ea3882] transition">Hubungi Kami</a></li>
                <li><a href="/kos" class="hover:text-[#ea3882] transition">Kos</a></li>
                <li><a href="/testimoni" class="hover:text-[#ea3882] transition">Testimoni</a></li>
            </ul>
        </div>

        <!-- Kolom 4: Jam Kerja -->
        <div>
            <h3 class="text-lg font-semibold text-[#d12670] mb-3">Jam Kerja</h3>
            <p class="text-sm">Senin - Jumat: <span class="font-medium text-[#d12670]">08.00 - 17.00</span></p>
            <p class="text-sm">Sabtu: <span class="font-medium text-[#d12670]">09.00 - 15.00</span></p>
            <p class="text-sm">Minggu & Libur Nasional: <span class="font-medium text-[#d12670]">Tutup</span></p>
        </div>
    </div>

    <div class="border-t border-pink-200 mt-10 pt-4 text-center text-xs text-pink-600">
        © {{ date('Y') }} <span class="font-semibold">Kozatly Indonesia</span> - Hak Cipta Dilindungi
    </div>
</footer>

<style>
    /* Tambah di app.css atau style <style> */
    .main-content footer {
        transition: padding-left 0.3s ease;
    }

    .main-content.ml-64 footer {
        padding-left: 0rem;
        /* pas sidebar lebar */
    }

    .main-content.ml-16 footer {
        padding-left: 0rem;
        /* kalau mau geser juga bisa diatur */
    }
</style>
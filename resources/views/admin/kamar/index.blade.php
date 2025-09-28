<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Kelola Kamar</title>
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50">

<!-- Notifikasi -->
<div class="m-8">
    @if(session('success'))
        <div id="alert-success" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">Sukses! </strong>
            <span class="block sm:inline">{{ session('success') }}</span>
            <span class="absolute top-0 bottom-0 right-0 px-4 py-3" onclick="this.parentElement.style.display='none';">
                <i class="fas fa-times"></i>
            </span>
        </div>
    @endif

    @if(session('error'))
        <div id="alert-error" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">Error! </strong>
            <span class="block sm:inline">{{ session('error') }}</span>
            <span class="absolute top-0 bottom-0 right-0 px-4 py-3" onclick="this.parentElement.style.display='none';">
                <i class="fas fa-times"></i>
            </span>
        </div>
    @endif
</div>

<!-- Judul -->
<div class="bg-white rounded-xl shadow p-6 border-l-4 border-blue-400 m-8 flex flex-col md:flex-row md:justify-between md:items-center">
    <div>
        <h1 class="text-2xl font-bold mb-3 text-pink-500">Kelola Kamar</h1>
        <p class="text-sm text-gray-600">
            Lihat dan kelola semua kamar <span class="font-bold text-blue-400">Koztly</span> beserta status ketersediaannya.
        </p>
    </div>
</div>

<!-- Statistik + Top 3 Kosan -->
<div class="flex flex-wrap gap-6 m-8">
    <!-- Statistik -->
    <div class="flex-1 min-w-[300px] flex gap-4">
        <div class="bg-white rounded-2xl shadow flex-1 border-t-4 border-pink-400">
            <div class="flex justify-between items-center p-4 mb-2">
                <h2 class="text-sm font-medium text-gray-500">Total Kamar</h2>
                <div class="bg-pink-100 text-pink-500 p-2 rounded-xl">
                    <i class="fas fa-bed text-lg"></i>
                </div>
            </div>
            <div class="flex flex-col justify-center items-center py-6">
                <p class="text-2xl font-bold text-gray-800">{{ $totalKamar }}</p>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow flex-1 border-t-4 border-blue-400">
            <div class="flex justify-between items-center p-4 mb-2">
                <h2 class="text-sm font-medium text-gray-500">Tersedia</h2>
                <div class="bg-blue-100 text-blue-500 p-2 rounded-xl">
                    <i class="fas fa-check text-lg"></i>
                </div>
            </div>
            <div class="flex flex-col justify-center items-center py-6">
                <p class="text-2xl font-bold text-gray-800">{{ $tersedia }}</p>
                <p class="text-xs text-blue-500 mt-1">{{ $persentaseTersedia }}% dari total kamar</p>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow flex-1 border-t-4 border-pink-400">
            <div class="flex justify-between items-center p-4 mb-2">
                <h2 class="text-sm font-medium text-gray-500">Terisi</h2>
                <div class="bg-pink-100 text-pink-500 p-2 rounded-xl">
                    <i class="fas fa-user text-lg"></i>
                </div>
            </div>
            <div class="flex flex-col justify-center items-center py-6">
                <p class="text-2xl font-bold text-gray-800">{{ $terisi }}</p>
                <p class="text-xs text-pink-500 mt-1">{{ $persentaseTerisi }}% dari total kamar</p>
            </div>
        </div>
    </div>

    <!-- Top 3 Kosan -->
    <div class="flex-1 min-w-[250px] flex flex-col gap-2">
        <h2 class="text-sm font-semibold text-gray-700 mb-2">Top 3 Kosan dengan jumlah kamar terbanyak</h2>

        @foreach ($topKosan as $kosan)
        <div class="bg-gray-50 rounded-xl p-2 flex justify-between items-center border-l-4 border-pink-400 shadow-sm">
            <div class="flex flex-col justify-center">
                <p class="font-medium text-gray-700 text-sm">{{ $kosan->nama_kos }}</p>
                <p class="text-xs text-gray-500 text-center">{{ $kosan->jumlah_kamar }} kamar</p>
            </div>
            <i class="fas fa-bed text-pink-500 text-xl"></i>
        </div>
        @endforeach
    </div>
</div>

<!-- Form Pencarian & Filter -->
<form method="GET" action="{{ route('admin.kamar.index') }}" class="bg-white p-4 rounded-2xl shadow flex flex-col md:flex-row gap-4 items-center m-8">
    <input type="text" name="search" placeholder="Cari nomor kamar..." value="{{ request('search') }}"
           class="flex-1 border border-gray-300 rounded-xl p-2 focus:outline-none focus:ring-2 focus:ring-pink-400" />

    <select name="kosan" class="border border-gray-300 rounded-xl p-2 focus:outline-none focus:ring-2 focus:ring-pink-400">
        <option value="">Semua Kosan</option>
        @foreach ($kosanList as $kosan)
            <option value="{{ $kosan->id_kos }}" {{ request('kosan') == $kosan->id_kos ? 'selected' : '' }}>
                {{ $kosan->nama_kos }}
            </option>
        @endforeach
    </select>

    <select name="status" class="border border-gray-300 rounded-xl p-2 focus:outline-none focus:ring-2 focus:ring-pink-400">
        <option value="">Semua Status</option>
        <option value="tersedia" {{ request('status') == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
        <option value="dibooking" {{ request('status') == 'dibooking' ? 'selected' : '' }}>Dibooking</option>
    </select>

    <button type="submit" class="bg-pink-500 text-white rounded-xl px-4 py-2 flex items-center gap-2 hover:bg-pink-600 ml-auto">
        <i class="fas fa-search"></i> Cari
    </button>

    <a href="{{ route('admin.kamar.index') }}" class="bg-gray-100 text-gray-700 rounded-xl px-4 py-2 flex items-center gap-2 hover:bg-gray-200">
        <i class="fas fa-rotate-right"></i> Reset
    </a>
</form>

<!-- Tabel Kamar -->
<div class="bg-white rounded-2xl shadow p-4 m-8">
    <div class="flex justify-between items-center mb-4">
        <h2 class="font-semibold text-lg">Daftar Kamar</h2>
        <div class="flex gap-2">
            <button id="btnTambah" 
               class="bg-blue-400 text-white px-4 py-2 rounded-lg flex items-center gap-2 hover:bg-blue-500">
               <i class="fas fa-plus"></i> Tambah
            </button>
        </div>
    </div>

    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-blue-200">
            <tr>
                <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">ID</th>
                <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Nomor Kamar</th>
                <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Kosan</th>
                <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Fasilitas</th>
                <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Status</th>
                <th class="px-4 py-2 text-center text-sm font-medium text-gray-700">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
        @forelse ($kamar as $index => $k)
        <tr class="hover:bg-gray-50">
            <td class="px-4 py-2 text-sm text-gray-700">{{ $index + 1 }}</td>
            <td class="px-4 py-2 flex items-center gap-2 text-sm text-gray-700">
                <div class="bg-pink-100 text-pink-500 w-6 h-6 flex items-center justify-center rounded-full">
                    <i class="fas fa-bed text-xs"></i>
                </div>
                {{ $k->nomor_kamar }}
            </td>
            <td class="px-4 py-2 text-sm text-gray-700">{{ $k->kosan->nama_kos ?? '-' }}</td>
            <td class="px-4 py-2 text-sm text-gray-700">
                @if(!empty($k->kosan->fasilitas)) 
                    @foreach (explode(',', $k->kosan->fasilitas) as $f)
                        <span class="inline-block bg-gray-100 text-gray-800 px-2 py-1 rounded-full text-xs mr-1 mb-1">{{ $f }}</span>
                    @endforeach
                @else
                    <span class="text-gray-400 text-xs">Tidak ada</span>
                @endif
            </td>
            <td class="px-4 py-2 text-sm">
                @if ($k->status == 'tersedia')
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                        Tersedia
                    </span>
                @else
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-pink-100 text-pink-800">
                        Dibooking
                    </span>
                @endif
            </td>
            <td class="px-4 py-2 text-center flex justify-center gap-2">
                <!-- Detail -->
                <button onclick="showDetail({
                    nomor_kamar: '{{ $k->nomor_kamar }}',
                    kosan: { nama_kos: '{{ $k->kosan->nama_kos ?? '' }}' },
                    status: '{{ $k->status }}',
                    penyewa: '{{ $k->booking_kos->user->nama ?? '-' }}'
                })" 
                class="bg-blue-500 text-white px-3 py-1 rounded-lg hover:bg-blue-600 flex items-center gap-1">
                    <i class="fas fa-info-circle"></i> Detail
                </button>

                <!-- Tombol Edit -->
                 <button data-id="{{ $k->id_kamar }}"
                 data-nomor="{{ $k->nomor_kamar }}"
                 data-kos="{{ $k->id_kos }}"
                 data-status="{{ $k->status }}"
                 onclick="showEdit(this)"
                 class="bg-yellow-500 text-white px-3 py-1 rounded-lg hover:bg-yellow-600 flex items-center gap-1">
                 <i class="fas fa-edit"></i></button>

                <!-- Hapus -->
                <form method="POST" action="{{ route('admin.kamar.destroy', $k->id_kamar) }}" onsubmit="return confirm('Yakin ingin menghapus kamar ini?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded-lg hover:bg-red-600 flex items-center gap-1">
                        <i class="fas fa-trash"></i> Hapus
                    </button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="7" class="py-12">
                <div class="flex flex-col items-center justify-center text-gray-400 gap-2">
                    <i class="fas fa-house text-4xl text-pink-500"></i>
                    <span class="text-gray-500">Belum Ada Data Kamar</span>
                </div>
            </td>
        </tr>
        @endforelse
        </tbody>
    </table>
</div>

<!-- Modal Tambah Kamar -->
<div id="modalTambah" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
    <div class="bg-white rounded-xl shadow-xl w-full max-w-md p-6 relative">
        <h2 class="text-xl font-semibold mb-4 text-pink-500">Tambah Kamar</h2>
        <form method="POST" action="{{ route('admin.kamar.store') }}">
            @csrf
            <div class="mb-4">
                <label for="nomor_kamar" class="block text-gray-700 text-sm font-medium mb-1">Nomor Kamar</label>
                <input type="text" name="nomor_kamar" id="nomor_kamar" required
                       class="w-full border border-gray-300 rounded-xl p-2 focus:outline-none focus:ring-2 focus:ring-pink-400">
            </div>

            <div class="mb-4">
                <label for="id_kos" class="block text-gray-700 text-sm font-medium mb-1">Kosan</label>
                <select name="id_kos" id="id_kos" required
                        class="w-full border border-gray-300 rounded-xl p-2 focus:outline-none focus:ring-2 focus:ring-pink-400">
                    <option value="">Pilih Kosan</option>
                    @foreach($kosanList as $kosan)
                        <option value="{{ $kosan->id_kos }}">{{ $kosan->nama_kos }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="status" class="block text-gray-700 text-sm font-medium mb-1">Status</label>
                <select name="status" id="status" required
                        class="w-full border border-gray-300 rounded-xl p-2 focus:outline-none focus:ring-2 focus:ring-pink-400">
                    <option value="tersedia">Tersedia</option>
                    <option value="dibooking">Dibooking</option>
                </select>
            </div>

            <div class="flex justify-end gap-2">
                <button type="button" onclick="closeModal()" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-xl hover:bg-gray-300">Batal</button>
                <button type="submit" class="bg-pink-500 text-white px-4 py-2 rounded-xl hover:bg-pink-600">Simpan</button>
            </div>
        </form>

        <button onclick="closeModal()" class="absolute top-3 right-3 text-gray-400 hover:text-gray-600">
            <i class="fas fa-times"></i>
        </button>
    </div>
</div>

<!-- Modal Edit Kamar -->
<div id="modalEdit" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
    <div class="bg-white rounded-xl shadow-xl w-full max-w-md p-6 relative">
        <h2 class="text-xl font-semibold mb-4 text-pink-500">Edit Kamar</h2>
        <form id="formEdit" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="edit_nomor_kamar" class="block text-gray-700 text-sm font-medium mb-1">Nomor Kamar</label>
                <input type="text" name="nomor_kamar" id="edit_nomor_kamar" required
                       class="w-full border border-gray-300 rounded-xl p-2 focus:outline-none focus:ring-2 focus:ring-pink-400">
            </div>

            <div class="mb-4">
                <label for="edit_id_kos" class="block text-gray-700 text-sm font-medium mb-1">Kosan</label>
                <select name="id_kos" id="edit_id_kos" required
                        class="w-full border border-gray-300 rounded-xl p-2 focus:outline-none focus:ring-2 focus:ring-pink-400">
                    <option value="">Pilih Kosan</option>
                    @foreach($kosanList as $kosan)
                        <option value="{{ $kosan->id_kos }}">{{ $kosan->nama_kos }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="edit_status" class="block text-gray-700 text-sm font-medium mb-1">Status</label>
                <select name="status" id="edit_status" required
                        class="w-full border border-gray-300 rounded-xl p-2 focus:outline-none focus:ring-2 focus:ring-pink-400">
                    <option value="tersedia">Tersedia</option>
                    <option value="dibooking">Dibooking</option>
                </select>
            </div>

            <div class="flex justify-end gap-2">
                <button type="button" onclick="closeEditModal()" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-xl hover:bg-gray-300">Batal</button>
                <button type="submit" class="bg-pink-500 text-white px-4 py-2 rounded-xl hover:bg-pink-600">Simpan</button>
            </div>
        </form>

        <button onclick="closeEditModal()" class="absolute top-3 right-3 text-gray-400 hover:text-gray-600">
            <i class="fas fa-times"></i>
        </button>
    </div>
</div>

<!-- Modal Detail -->
<div id="modalDetail" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
    <div class="bg-white rounded-xl shadow-xl w-full max-w-md p-6 relative">
        <h2 class="text-xl font-semibold mb-4 text-blue-500">Detail Kamar</h2>
        <div class="space-y-2">
            <p><strong>Nomor Kamar:</strong> <span id="detail_nomor"></span></p>
            <p><strong>Kosan:</strong> <span id="detail_kosan"></span></p>
            <p><strong>Status:</strong> <span id="detail_status"></span></p>
            <p><strong>Penyewa:</strong> <span id="detail_penyewa"></span></p>
        </div>

        <button onclick="closeDetailModal()" class="absolute top-3 right-3 text-gray-400 hover:text-gray-600">
            <i class="fas fa-times"></i>
        </button>
    </div>
</div>

<script>
    // Modal Tambah
    const modalTambah = document.getElementById('modalTambah');
    document.getElementById('btnTambah').addEventListener('click', () => modalTambah.classList.remove('hidden'));
    function closeModal(){ modalTambah.classList.add('hidden'); }

    // Modal Edit
    const modalEdit = document.getElementById('modalEdit');
    const formEdit = document.getElementById('formEdit');
   function showEdit(btn){
    const id = btn.dataset.id;
    const nomor = btn.dataset.nomor;
    const kos = btn.dataset.kos;
    const status = btn.dataset.status;

    document.getElementById('edit_nomor_kamar').value = nomor;
    document.getElementById('edit_id_kos').value = kos;
    document.getElementById('edit_status').value = status;

    // Set action form ke URL update kamar yang dipilih
    formEdit.action = '/admin/kamar/' + id;

    modalEdit.classList.remove('hidden');
}

    function closeEditModal(){ modalEdit.classList.add('hidden'); }

    // Modal Detail
    const modalDetail = document.getElementById('modalDetail');
    function showDetail(kamar){
        document.getElementById('detail_nomor').innerText = kamar.nomor_kamar;
        document.getElementById('detail_kosan').innerText = kamar.kosan.nama_kos;
        document.getElementById('detail_status').innerText = kamar.status;
        document.getElementById('detail_penyewa').innerText = kamar.penyewa ?? '-';
        modalDetail.classList.remove('hidden');
    }
    function closeDetailModal(){ modalDetail.classList.add('hidden'); }

     // Notifikasi otomatis hilang
        // Auto hide alert
        setTimeout(() => {
            const success = document.getElementById('alert-success');
            const error = document.getElementById('alert-error');
            
            if (success) {
                success.classList.add('opacity-0');
                setTimeout(() => success.remove(), 500);
            }
            if (error) {
                error.classList.add('opacity-0');
                setTimeout(() => error.remove(), 500);
            }
        }, 3000);
   
</script>

</body>
</html>

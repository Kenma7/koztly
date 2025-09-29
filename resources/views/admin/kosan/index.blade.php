<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Kosan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50 flex">

       <!-- Sidebar -->
    <aside id="sidebar" class="fixed left-0 top-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0 bg-white shadow-lg">
        <div class="h-full px-3 py-4 overflow-y-auto">
            <!-- Logo -->
            <div class="flex items-center justify-center mb-8 mt-4">
                <h1 class="text-2xl font-bold text-[#E93B81]">KOZTLY</h1>
            </div>
            
            <!-- Menu -->
            <ul class="space-y-2 font-medium">
                <li>
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center p-3 text-gray-700 rounded-lg hover:bg-gray-100">
                        <i class="fas fa-th-large w-5"></i>
                        <span class="ml-3">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.kosan.index') }}" class="flex items-center p-3 text-white bg-pink-500 rounded-lg hover:bg-pink-500 ">
                        <i class="fas fa-home w-5"></i>
                        <span class="ml-3">Kelola Kosan</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.kamar.index') }}" class="flex items-center p-3 text-gray-700 rounded-lg hover:bg-gray-100">
                        <i class="fas fa-door-open w-5"></i>
                        <span class="ml-3">Kelola Kamar</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.booking.index') }}" class="flex items-center p-3 text-gray-700 rounded-lg hover:bg-gray-100">
                        <i class="fas fa-calendar-check w-5"></i>
                        <span class="ml-3">Kelola Booking</span>
                    </a>
                </li>
                <li>
                    <form action="{{ route('admin.logout') }}" method="POST" class="mt-8">
                        @csrf
                        <button type="submit" class="flex items-center p-3 w-full text-red-600 rounded-lg hover:bg-red-50">
                            <i class="fas fa-sign-out-alt w-5"></i>
                            <span class="ml-3">Logout</span>
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </aside>

   

<!-- main -->
<main class="flex-1 ml-64">

 <!-- Notifikasi -->
    @if(session('success'))
    <div id="alert-success" class="m-8 p-4 rounded-lg bg-green-100 text-green-800 transition-opacity duration-700">
        {{ session('success') }}
    </div>
    @endif
    @if(session('error'))
    <div id="alert-error" class="m-8 p-4 rounded-lg bg-red-100 text-red-800 transition-opacity duration-700">
        {{ session('error') }}
    </div>
    @endif

    <!-- judul halaman -->
    <div class="bg-white rounded-xl shadow p-6 border-l-4 border-pink-500 m-8">
        <h1 class="text-2xl font-bold mb-3">Kelola Kosan</h1>
        <p class="text-sm text-gray-600">
            Kelola semua kosan yang sudah terdaftar di <span class="font-bold text-[#E93B81]">Koztly</span> dengan mudah dalam satu tempat.
        </p>
    </div>

    <!-- Statistik -->
    <div class="grid grid-cols-3 gap-4 m-8">
        <div class="bg-gray-100 rounded-xl shadow p-4 text-center">
            <i class="fas fa-home text-black text-2xl mb-2"></i>
            <h3 class="text-xl font-bold text-gray-800">{{ $totalKosan }}</h3>
            <p class="text-xs text-gray-600">Total Kosan</p>
        </div>
        <div class="bg-pink-100 rounded-xl shadow p-4 text-center">
            <i class="fas fa-venus text-pink-500 text-2xl mb-2"></i>
            <h3 class="text-xl font-bold text-gray-800">{{ $kosanWanita }}</h3>
            <p class="text-xs text-gray-600">Kosan Wanita</p>
        </div>
        <div class="bg-blue-100 rounded-xl shadow p-4 text-center">
            <i class="fas fa-mars text-blue-500 text-2xl mb-2"></i>
            <h3 class="text-xl font-bold text-gray-800">{{ $kosanPria }}</h3>
            <p class="text-xs text-gray-600">Kosan Pria</p>
        </div>
    </div>

    <!-- Filter -->
    <form action="{{ route('admin.kosan.index') }}" method="GET" class="bg-white p-6 rounded-2xl shadow m-8">
        <h1 class="text-base font-semibold mb-3 flex items-center gap-2">
            <i class="fas fa-magnifying-glass text-pink-500"></i>
            Pencarian dan Filter Kosan
        </h1>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-3 items-end">
            <div>
                <label class="block text-xs font-medium text-gray-700 mb-4">Cari Kosan</label>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Nama kosan atau lokasi..."
                       class="w-full border border-gray-300 rounded-2xl px-2 py-1 text-sm focus:outline-none focus:ring-2 focus:ring-pink-500">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-700 mb-4">Status Kosan</label>
                <select name="status" class="w-full border border-gray-300 rounded-2xl px-2 py-1 text-sm focus:outline-none focus:ring-2 focus:ring-pink-500">
                    <option value="">Semua Status</option>
                    <option value="aktif" {{ request('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="nonaktif" {{ request('status') == 'nonaktif' ? 'selected' : '' }}>Non Aktif</option>
                </select>
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-700 mb-4">Kategori Kosan</label>
                <select name="kategori" class="w-full border border-gray-300 rounded-2xl px-2 py-1 text-sm focus:outline-none focus:ring-2 focus:ring-pink-500">
                    <option value="">Semua Kategori</option>
                    <option value="wanita" {{ request('kategori') == 'wanita' ? 'selected' : '' }}>Wanita</option>
                    <option value="pria" {{ request('kategori') == 'pria' ? 'selected' : '' }}>Pria</option>
                    <option value="bebas" {{ request('kategori') == 'bebas' ? 'selected' : '' }}>Bebas</option>
                </select>
            </div>
        </div>
        <div class="mt-3 flex justify-end gap-2">
            <button type="submit" class="bg-pink-500 text-white px-3 py-1 rounded hover:bg-pink-600 text-sm flex items-center gap-1">
                <i class="fas fa-filter text-sm"></i> Filter
            </button>
            <a href="{{ route('admin.kosan.index') }}" class="bg-gray-200 text-gray-700 px-3 py-1 rounded hover:bg-gray-300 text-sm flex items-center gap-1">
                <i class="fas fa-rotate-left text-sm"></i> Reset
            </a>
        </div>
    </form>

    <!-- Tabel Kosan -->
    <div class="bg-white shadow rounded-2xl p-6 m-8 overflow-x-auto">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-semibold">Daftar Kosan</h2>
            <a href="#" id="btnTambah" 
               class="bg-pink-500 text-white px-4 py-2 rounded-lg hover:bg-pink-600 flex items-center gap-2 text-sm">
                <i class="fas fa-plus"></i> Tambah Kosan
            </a>
        </div>
        <table class="min-w-full table-auto">
            <thead class="bg-pink-200 rounded-t-2xl">
                <tr>
                    <th class="px-4 py-2 text-left text-gray-600">ID</th>
                    <th class="px-4 py-2 text-left text-gray-600">Nama Kosan</th>
                    <th class="px-4 py-2 text-left text-gray-600">Lokasi</th>
                    <th class="px-4 py-2 text-left text-gray-600">Kategori</th>
                    <th class="px-4 py-2 text-center text-gray-600">Jumlah Kamar</th>
                    <th class="px-4 py-2 text-left text-gray-600">Harga</th>
                    <th class="px-4 py-2 text-left text-gray-600">Status</th>
                    <th class="px-4 py-2 text-left text-gray-600">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-justify">
                @forelse ($kosan as $k)
                <tr>
                    <td class="px-4 py-2">{{ $k->id_kos }}</td>
                    <td class="px-4 py-2">{{ $k->nama_kos }}</td>
                    <td class="px-4 py-2">{{ $k->lokasi_kos }}</td>
                    <td class="px-4 py-2 capitalize">{{ $k->kategori }}</td>
                    <td class="px-4 py-2 text-center">{{ $k->jumlah_kamar }}</td>
                    <td class="px-4 py-2">Rp {{ number_format($k->harga, 0, ',', '.') }}</td>
                    <td class="px-4 py-2">
                        @if($k->status == 'aktif')
                            <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs">Aktif</span>
                        @else
                            <span class="bg-red-100 text-red-800 px-2 py-1 rounded-full text-xs">Non Aktif</span>
                        @endif
                    </td>
                    <td class="px-4 py-2 flex text-center gap-2">
                        <!-- Tombol Detail -->
                        <a href="#" class="text-blue-500 hover:text-blue-700" onclick="openDetailModal({{ $k->id_kos }})">
                            <i class="fas fa-eye"></i>
                        </a>
                        <!-- Tombol Edit -->
                        <a href="#" class="text-yellow-500 hover:text-yellow-700" onclick="openEditModal({{ $k->id_kos }})">
                            <i class="fas fa-edit"></i>
                        </a>
                        <!-- Tombol Hapus -->
                        <form action="{{ route('admin.kosan.destroy', $k->id_kos) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                    </td>
                </tr>
  </main>

                <!-- Modal Detail Kosan -->
                <div id="modalDetail-{{ $k->id_kos }}" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
                    <div class="bg-white rounded-xl shadow-lg w-96 p-6 relative">
                        <button onclick="closeDetailModal({{ $k->id_kos }})" class="absolute top-3 right-3 text-gray-500 hover:text-gray-700">
                            <i class="fas fa-times"></i>
                        </button>
                        <h2 class="text-lg font-bold mb-4">{{ $k->nama_kos }}</h2>
                        @if($k->gambar_kos)
                        <!-- directory gambar -->
                            <img src="{{ asset('uploads/kosan/'.$k->gambar_kos) }}" alt="gambar kosan" class="w-full h-40 object-cover rounded mb-4">
                        @endif
                        <div class="text-sm text-gray-700 space-y-2">
                            <p><span class="font-semibold">Lokasi:</span> {{ $k->lokasi_kos }}</p>
                            <p><span class="font-semibold">Kategori:</span> {{ ucfirst($k->kategori) }}</p>
                            <p><span class="font-semibold">Jumlah Kamar:</span> {{ $k->jumlah_kamar }}</p>
                            <p><span class="font-semibold">Harga:</span> Rp {{ number_format($k->harga, 0, ',', '.') }}</p>
                            <p><span class="font-semibold">Fasilitas:</span> {{ $k->fasilitas ?? '-' }}</p>
                            <p><span class="font-semibold">Status:</span>
                                @if($k->status == 'aktif')
                                    <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs">Aktif</span>
                                @else
                                    <span class="bg-red-100 text-red-800 px-2 py-1 rounded-full text-xs">Non Aktif</span>
                                @endif
                            </p>
                            <p><span class="font-semibold">No. Rekening:</span> {{ $k->no_rek }}</p>
                        </div>
                        <div class="flex justify-end mt-4">
                            <button onclick="closeDetailModal({{ $k->id_kos }})" class="px-4 py-1 rounded bg-gray-200 hover:bg-gray-300">Tutup</button>
                        </div>
                    </div>
                </div>

                <!-- Modal Edit Kosan -->
                <div id="modalEdit-{{ $k->id_kos }}" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
                    <div class="bg-white rounded-xl shadow-lg w-96 p-6 relative">
                        <h2 class="text-lg font-bold mb-4">Edit Kosan</h2>
                        <form action="{{ route('admin.kosan.update', $k->id_kos) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Kosan</label>
                                <input type="text" name="nama_kos" value="{{ $k->nama_kos }}" class="w-full border px-2 py-1 rounded" required>
                            </div>
                            <div class="mb-3">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Lokasi</label>
                                <input type="text" name="lokasi_kos" value="{{ $k->lokasi_kos }}" class="w-full border px-2 py-1 rounded" required>
                            </div>
                            <div class="mb-3">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Jumlah Kamar</label>
                                <input type="number" name="jumlah_kamar" value="{{ $k->jumlah_kamar }}" class="w-full border px-2 py-1 rounded" min="1" required>
                            </div>
                            <div class="mb-3">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                                <select name="kategori" class="w-full border px-2 py-1 rounded" required>
                                    <option value="wanita" {{ $k->kategori == 'wanita' ? 'selected' : '' }}>Wanita</option>
                                    <option value="pria" {{ $k->kategori == 'pria' ? 'selected' : '' }}>Pria</option>
                                    <option value="bebas" {{ $k->kategori == 'bebas' ? 'selected' : '' }}>Bebas</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Harga</label>
                                <input type="number" name="harga" value="{{ $k->harga }}" class="w-full border px-2 py-1 rounded" min="0" required>
                            </div>
                            <div class="mb-3">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                                <select name="status" class="w-full border px-2 py-1 rounded">
                                    <option value="aktif" {{ $k->status == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                    <option value="nonaktif" {{ $k->status == 'nonaktif' ? 'selected' : '' }}>Non Aktif</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="block text-sm font-medium text-gray-700 mb-1">No. Rekening</label>
                                <input type="text" name="no_rek" value="{{ $k->no_rek}}" class="w-full border px-2 py-1 rounded" required>
                            </div>
                            <div class="mb-3">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Gambar Kosan</label>
                                @if($k->gambar_kos)
                                <!-- directory gambar kos -->
                                    <img src="{{ asset('uploads/kosan/'.$k->gambar_kos) }}" alt="gambar kosan" class="w-32 h-24 object-cover rounded mb-2">
                                @endif
                                <input type="file" name="gambar_kos" class="w-full border px-2 py-1 rounded" accept="image/*">
                                <small class="text-xs text-gray-500">Kosongkan jika tidak ingin mengganti gambar</small>
                            </div>
                            <div class="flex justify-end gap-2">
                                <button type="button" onclick="closeEditModal({{ $k->id_kos }})" class="px-4 py-1 rounded bg-gray-200 hover:bg-gray-300">Batal</button>
                                <button type="submit" class="px-4 py-1 rounded bg-pink-500 text-white hover:bg-pink-600">Update</button>
                            </div>
                        </form>
                    </div>
                </div>

                @empty
                <tr>
                    <td colspan="8" class="py-12">
                        <div class="flex flex-col items-center justify-center text-gray-400 gap-2">
                            <i class="fas fa-house text-4xl text-pink-500"></i>
                            <span class="text-gray-500">Belum Ada Data Kosan</span>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Modal Tambah Kosan -->
    <div id="modalTambah" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
        <div class="bg-white rounded-xl shadow-lg w-96 p-6 relative">
            <h2 class="text-lg font-bold mb-4">Tambah Kosan</h2>
            <form action="{{ route('admin.kosan.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Kosan</label>
                    <input type="text" name="nama_kos" class="w-full border px-2 py-1 rounded" required>
                </div>
                <div class="mb-3">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Lokasi</label>
                    <input type="text" name="lokasi_kos" class="w-full border px-2 py-1 rounded" required>
                </div>
                <div class="mb-3">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Jumlah Kamar</label>
                    <input type="number" name="jumlah_kamar" class="w-full border px-2 py-1 rounded" min="1" required>
                </div>
                <div class="mb-3">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Fasilitas</label>
                    <textarea name="fasilitas" class="w-full border px-2 py-1 rounded" rows="3"></textarea>
                </div>
                <div class="mb-3">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                    <select name="kategori" class="w-full border px-2 py-1 rounded" required>
                        <option value="wanita">Wanita</option>
                        <option value="pria">Pria</option>
                        <option value="bebas">Bebas</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Harga</label>
                    <input type="number" name="harga" class="w-full border px-2 py-1 rounded" min="0" required>
                </div>
                <div class="mb-3">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Gambar Kosan</label>
                    <input type="file" name="gambar_kos" class="w-full border px-2 py-1 rounded" accept="image/*" required>
                </div>
                <div class="mb-3">
                    <label class="block text-sm font-medium text-gray-700 mb-1">No. Rekening</label>
                    <input type="text" name="no_rek" class="w-full border px-2 py-1 rounded" required>
                </div>
                <div class="flex justify-end gap-2">
                    <button type="button" id="btnClose" class="px-4 py-1 rounded bg-gray-200 hover:bg-gray-300">Batal</button>
                    <button type="submit" class="px-4 py-1 rounded bg-pink-500 text-white hover:bg-pink-600">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Script modal -->
    <script>
        const btnTambah = document.getElementById('btnTambah');
        const modalTambah = document.getElementById('modalTambah');
        const btnClose = document.getElementById('btnClose');

        btnTambah.addEventListener('click', function(e){
            e.preventDefault();
            modalTambah.classList.remove('hidden');
        });
        btnClose.addEventListener('click', function(){
            modalTambah.classList.add('hidden');
        });

        function openEditModal(id){
            document.getElementById('modalEdit-'+id).classList.remove('hidden');
        }
        function closeEditModal(id){
            document.getElementById('modalEdit-'+id).classList.add('hidden');
        }

        function openDetailModal(id){
            document.getElementById('modalDetail-'+id).classList.remove('hidden');
        }
        function closeDetailModal(id){
            document.getElementById('modalDetail-'+id).classList.add('hidden');
        }

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

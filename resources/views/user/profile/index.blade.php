@extends('layouts.app')

@section('content')
    <div class="bg-gray-50 py-8 rounded-lg" style="min-height: 100vh;">
        <div class="container mx-auto px-4" style="max-width: 800px;">

            <a href="{{ route('kosan.index') }}"
                class="inline-flex items-center gap-2 text-[#ea3882] hover:text-[#d12670] font-semibold mb-6">
                <i class="fas fa-arrow-left"></i>
                <span>Kembali ke Beranda</span>
            </a>

            <!-- Header -->
            <div class="mb-6">
                <h1 class="text-3xl font-bold text-gray-800 mb-1">Profile Saya</h1>
                <p class="text-gray-600">Kelola informasi profil Anda</p>
            </div>

            <!-- Success Alert -->
            @if (session('success'))
                <div class="bg-green-50 border-l-4 border-green-500 text-green-800 px-6 py-4 rounded-lg mb-6">
                    <div class="flex items-center gap-3">
                        <i class="fas fa-check-circle text-xl"></i>
                        <span>{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            <!-- Main Card -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <!-- Card Header -->
                <div class="bg-gradient-to-r from-[#ea3882] to-[#d12670] p-6 rounded-t-lg">
                    <div class="flex items-center gap-4">
                        <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center">
                            <i class="fas fa-user text-3xl text-[#ea3882]"></i>
                        </div>
                        <div class="text-white">
                            <h2 class="text-2xl font-bold">{{ $user->name ?? 'User' }}</h2>
                        </div>
                    </div>
                </div>

                <!-- Form -->
                <form method="POST" action="{{ route('user.profile.update') }}" class="p-6">
                    @csrf

                    <div class="space-y-5">
                        <!-- Name -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-user text-[#ea3882] mr-1"></i>
                                Nama Lengkap
                            </label>
                            <input type="text" name="name" value="{{ old('name', $user->name ?? '') }}"
                                class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-[#ea3882] focus:border-transparent transition disabled:bg-gray-50 disabled:text-gray-600"
                                disabled>
                            @error('name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Username -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-at text-[#ea3882] mr-1"></i>
                                Username
                            </label>
                            <input type="text" name="username" value="{{ old('username', $user->username ?? '') }}"
                                class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-[#ea3882] focus:border-transparent transition disabled:bg-gray-50 disabled:text-gray-600"
                                disabled>
                            @error('username')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Gender -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-venus-mars text-[#ea3882] mr-1"></i>
                                Jenis Kelamin
                            </label>
                            <select name="gender"
                                class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-[#ea3882] focus:border-transparent transition bg-gray-50 disabled:text-gray-1000"
                                disabled>
                                <option value="">-- Pilih Jenis Kelamin --</option>
                                <option value="pria" {{ ($user->gender ?? '') === 'pria' ? 'selected' : '' }}>Pria
                                </option>
                                <option value="wanita" {{ ($user->gender ?? '') === 'wanita' ? 'selected' : '' }}>Wanita
                                </option>
                            </select>
                            @error('gender')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-envelope text-[#ea3882] mr-1"></i>
                                Email
                            </label>
                            <input type="email" name="email" value="{{ old('email', $user->email ?? '') }}"
                                class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-[#ea3882] focus:border-transparent transition disabled:bg-gray-50 disabled:text-gray-600"
                                disabled>
                            @error('email')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Phone Number -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-phone text-[#ea3882] mr-1"></i>
                                Nomor Telepon
                            </label>
                            <input type="text" name="phone_number"
                                value="{{ old('phone_number', $user->phone_number ?? '') }}"
                                class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-[#ea3882] focus:border-transparent transition disabled:bg-gray-50 disabled:text-gray-600"
                                disabled placeholder="08xxxxxxxxxx">
                            @error('phone_number')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Info Box -->
                    <div class="mt-6 bg-[#ffe6e2] border border-[#f5acca] rounded-lg p-4">
                        <div class="flex items-start gap-3">
                            <i class="fas fa-info-circle text-[#ea3882] mt-0.5"></i>
                            <div>
                                <p class="text-sm text-gray-700">
                                    <span class="font-semibold">Catatan:</span> Klik tombol <strong>Edit</strong> untuk
                                    mengubah informasi profil Anda.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex justify-end gap-3 mt-6 pt-6 border-t border-gray-200">
                        <button type="button" id="editBtn"
                            class="bg-[#b8caef] hover:bg-[#9ab5e8] text-white font-semibold px-6 py-3 rounded-lg transition flex items-center gap-2">
                            <i class="fas fa-edit"></i>
                            Edit Profile
                        </button>
                        <button type="submit" id="saveBtn"
                            class="bg-gradient-to-r from-[#ea3882] to-[#d12670] hover:from-[#d12670] hover:to-[#b81e5a] text-white font-semibold px-6 py-3 rounded-lg transition hidden flex items-center gap-2">
                            <i class="fas fa-save"></i>
                            Simpan Perubahan
                        </button>
                        <button type="button" id="cancelBtn"
                            class="bg-white border-2 border-gray-300 text-gray-700 hover:bg-gray-50 font-semibold px-6 py-3 rounded-lg transition hidden flex items-center gap-2">
                            <i class="fas fa-times"></i>
                            Batal
                        </button>
                    </div>
                </form>
            </div>

            <!-- Additional Info Cards -->
            <div class="grid md:grid-cols-1 gap-4 mt-6">
                <!-- Member Since -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-5">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-10 h-10 bg-[#ffe6e9] rounded-lg flex items-center justify-center">
                            <i class="fas fa-calendar text-[#ea3882]"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-800">Bergabung Sejak</h3>
                            <p class="text-sm text-gray-600">{{ $user->created_at ?? '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
    const editBtn = document.getElementById('editBtn');
    const saveBtn = document.getElementById('saveBtn');
    const cancelBtn = document.getElementById('cancelBtn');
    const inputs = document.querySelectorAll('input, select');
    const form = document.querySelector('form');

    // Store original values
    const originalValues = {};
    inputs.forEach(input => {
        originalValues[input.name] = input.value;
    });

    // Edit button click
    editBtn.addEventListener('click', () => {
        inputs.forEach(input => {
            input.disabled = false;
            input.classList.remove('disabled:bg-gray-50', 'disabled:text-gray-600');
            input.classList.add('bg-white');
        });
        editBtn.classList.add('hidden');
        saveBtn.classList.remove('hidden');
        cancelBtn.classList.remove('hidden');
    });

    // Cancel button click
    cancelBtn.addEventListener('click', () => {
        inputs.forEach(input => {
            input.disabled = true;
            input.value = originalValues[input.name];
            input.classList.add('disabled:bg-gray-50', 'disabled:text-gray-600');
            input.classList.remove('bg-white');
        });
        saveBtn.classList.add('hidden');
        cancelBtn.classList.add('hidden');
        editBtn.classList.remove('hidden');
    });

    // Form submit confirmation pakai SweetAlert2
    form.addEventListener('submit', function(e) {
        e.preventDefault(); // cegah submit langsung

        Swal.fire({
            title: 'Simpan Perubahan?',
            text: "Apakah Anda yakin ingin menyimpan perubahan profil?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#ea3882',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, simpan',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit(); // submit form kalau confirm
            }
        });
    });
</script>
@endsection

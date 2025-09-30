<!-- resources/views/kosan/booking.blade.php -->
@extends('layouts.app')

@section('title', 'Booking Kosan - KosanKu')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto bg-white rounded-lg shadow-md p-6">
        <h1 class="text-2xl font-bold mb-6">Booking Kosan: {{ $kos->nama_kos }}</h1>
        
        <form method="POST" action="{{ route('kosan.booking.submit', $kos->id_kos) }}">
            @csrf
            
            <!-- Pilih Kamar -->
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Pilih Kamar</label>
                <select name="id_kamar" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <option value="">-- Pilih Kamar --</option>
                    @foreach($kos->kamar as $kamar)
                        <option value="{{ $kamar->id_kamar }}">
                            Kamar {{ $kamar->nomor_kamar }} - Rp {{ number_format($kos->harga, 0, ',', '.') }}/bulan
                        </option>
                    @endforeach
                </select>
            </div>
            
            <!-- Data Pemesan -->
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Nama Lengkap</label>
                <input type="text" name="nama" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
            
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">No. HP/WhatsApp</label>
                <input type="text" name="no_hp" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2">Tanggal Masuk</label>
                    <input type="date" name="tanggal_masuk" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2">Lama Sewa (bulan)</label>
                    <input type="number" name="lama_sewa" min="1" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
            </div>
            
            <button type="submit" class="w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 font-semibold">
                Booking Sekarang
            </button>
        </form>
    </div>
</div>
@endsection
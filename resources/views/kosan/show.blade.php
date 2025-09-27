<!DOCTYPE html>
<html>
<head>
    <title>Detail Kosan</title>
</head>
<body>
    <h1>{{ $kos->nama_kos }}</h1>
    <p>Lokasi: {{ $kos->lokasi_kos }}</p>
    <p>Harga: Rp {{ number_format($kos->harga) }}</p>
    <p>Jumlah Kamar: {{ $kos->jumlah_kamar }}</p>
    <p>Fasilitas: {{ $kos->fasilitas }}</p>
    <p>Kategori: {{ ucfirst($kos->kategori) }}</p>
    <p>Status: {{ ucfirst($kos->status) }}</p>

    <a href="{{ route('kosan.booking.form', $kos->id_kos) }}">Booking Sekarang</a>
    <br><br>
    <a href="{{ route('kosan.index') }}">Kembali ke Daftar Kosan</a>
</body>
</html>

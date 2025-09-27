<!DOCTYPE html>
<html>
<head>
    <title>Daftar Kosan</title>
</head>
<body>
    <h1>Daftar Kosan</h1>

    @foreach($kosan as $k)
        <div style="border:1px solid #ccc; padding:10px; margin-bottom:10px;">
            <h2>{{ $k->nama_kos }}</h2>
            <p>Lokasi: {{ $k->lokasi_kos }}</p>
            <p>Harga: Rp {{ number_format($k->harga) }}</p>
            <p>Jumlah Kamar: {{ $k->jumlah_kamar }}</p>
            <a href="{{ route('kosan.show', $k->id_kos) }}">Lihat Detail</a>
        </div>
    @endforeach
</body>
</html>

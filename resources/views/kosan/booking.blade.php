<!DOCTYPE html>
<html>
<head>
    <title>Booking Kosan</title>
</head>
<body>
    <h1>Booking Kosan: {{ $kos->nama_kos }}</h1>

    @if(session('success'))
        <p style="color: green">{{ session('success') }}</p>
    @endif

    @if($errors->any())
        <ul style="color: red;">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('kosan.booking.submit', $kos->id_kos) }}" method="POST">
        @csrf
        <label>Nama:</label><br>
        <input type="text" name="nama" value="{{ old('nama') }}" required><br><br>

        <label>No HP:</label><br>
        <input type="text" name="no_hp" value="{{ old('no_hp') }}" required><br><br>

        <label>Tanggal Mulai:</label><br>
        <input type="date" name="tanggal_mulai" value="{{ old('tanggal_mulai') }}" required><br><br>

        <label>Lama Sewa (hari):</label><br>
        <input type="number" name="lama_sewa" value="{{ old('lama_sewa') }}" min="1" required><br><br>

        <button type="submit">Booking Sekarang</button>
    </form>

    <br>
    <a href="{{ route('kosan.show', $kos->id_kos) }}">Kembali ke Detail Kosan</a>
</body>
</html>

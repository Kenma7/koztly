<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Booking #{{ $booking->id_booking }}</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            background-color: #fff8fc;
            color: #333;
            margin: 0;
            padding: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header img {
            width: 100px;
            margin-bottom: 10px;
        }

        h1 {
            font-size: 24px;
            color: #ff6fa3;
            margin-bottom: 5px;
        }

        .date {
            font-size: 14px;
            color: #666;
        }

        .section {
            margin-bottom: 20px;
            background-color: #fff0f7;
            border-radius: 10px;
            padding: 15px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }

        .section h2 {
            background-color: #ffd4e6;
            padding: 8px;
            border-radius: 8px;
            color: #ff6fa3;
            margin-bottom: 10px;
            font-size: 16px;
        }

        .row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 6px;
            font-size: 14px;
        }

        .row span:first-child {
            font-weight: 600;
            color: #555;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            font-size: 14px;
        }

        table, th, td {
            border: 1px solid #ffb6c1;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }

        .status-badge {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 600;
            color: #fff;
        }

        .status-bayar { background-color: #34d399; }   /* hijau */
        .status-belum { background-color: #fbbf24; }  /* kuning */
        .status-menunggu { background-color: #60a5fa; } /* biru */
        .status-batal { background-color: #f87171; } /* merah */
    </style>
</head>
<body>
    <div class="header">
        <img src="{{ public_path('images/logo.png') }}" alt="Logo Koztly">
        <h1>Detail Booking #{{ $booking->id_booking }}</h1>
        <p class="date">Tanggal: {{ \Carbon\Carbon::parse($booking->created_at)->format('d M Y') }}</p>
    </div>

    <div class="section">
        <h2>Informasi Kosan</h2>
        <div class="row"><span>Nama Kosan:</span><span>{{ $booking->kosan->nama_kos }}</span></div>
        <div class="row"><span>Lokasi:</span><span>{{ $booking->kosan->lokasi_kos }}</span></div>
        <div class="row"><span>Kamar:</span><span>{{ $booking->kamar->nomor_kamar ?? '-' }}</span></div>
        <div class="row"><span>Kategori:</span><span>{{ $booking->kosan->kategori }}</span></div>
    </div>

    <div class="section">
        <h2>Informasi Penyewa</h2>
        <div class="row"><span>Nama:</span><span>{{ $booking->user->username }}</span></div>
        <div class="row"><span>Jumlah Penghuni:</span><span>{{ $booking->jumlah_penghuni }} Orang</span></div>
        @if($booking->catatan)
        <div class="row"><span>Catatan:</span><span>{{ $booking->catatan }}</span></div>
        @endif
    </div>

    <div class="section">
        <h2>Rincian Biaya</h2>
        <div class="row"><span>Harga per bulan:</span><span>Rp {{ number_format($booking->kosan->harga,0,',','.') }}</span></div>
        <div class="row"><span>Lama sewa:</span><span>{{ $booking->lama_sewa }} bulan</span></div>
        <div class="row"><span>Total Biaya:</span><span>Rp {{ number_format($booking->harga,0,',','.') }}</span></div>
        <div class="row">
            <span>Status Pembayaran:</span>
            @php
                $statusBayarClass = $booking->status_pembayaran == 'sudah dibayar' ? 'status-bayar' : 'status-belum';
            @endphp
            <span class="status-badge {{ $statusBayarClass }}">{{ ucfirst($booking->status_pembayaran) }}</span>
        </div>
        <div class="row">
            <span>Status Sewa:</span>
            @php
                $statusSewaClass = $booking->status_sewa == 'aktif' ? 'status-bayar' : ($booking->status_sewa == 'menunggu' ? 'status-menunggu' : 'status-batal');
            @endphp
            <span class="status-badge {{ $statusSewaClass }}">{{ ucfirst($booking->status_sewa) }}</span>
        </div>
    </div>
        <div class="section" style="text-align: center; background-color: transparent; box-shadow: none; margin-top: 30px;">
        <p style="font-size:14px; color:#ff6fa3; font-weight:600;">
            Terima kasih telah mempercayai Koztly! 💖<br>
            Semoga kenyamanan kosanmu menyenangkan 😊
        </p>
    </div>

    
</body>
</html>

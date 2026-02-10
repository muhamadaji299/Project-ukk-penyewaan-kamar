<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservasi Kamar</title>

    <style>
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background-color: #f4f6f8;
            margin: 0;
        }

        header {
            background-color: #2c3e50;
            color: white;
            padding: 20px 40px;
        }

        header h1 {
            margin: 0;
            font-size: 22px;
        }

        .container {
            padding: 40px;
        }

        h2 {
            margin-bottom: 25px;
            color: #2c3e50;
        }

        /* grid card */
        .room-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
            gap: 20px;
        }

        .room-card {
            background-color: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.06);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .room-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 25px rgba(0,0,0,0.1);
        }

        .room-title {
            font-size: 18px;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 8px;
        }

        .room-price {
            color: #3498db;
            font-weight: bold;
            margin-bottom: 12px;
        }

        .room-status {
            font-size: 14px;
            margin-bottom: 15px;
        }

        .status-available {
            color: #27ae60;
            font-weight: 500;
        }

        .status-unavailable {
            color: #e74c3c;
            font-weight: 500;
        }

        .btn {
            display: inline-block;
            padding: 10px 16px;
            background-color: #3498db;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            font-size: 14px;
            transition: background 0.2s ease;
        }

        .btn:hover {
            background-color: #2980b9;
        }

        .empty {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            color: #7f8c8d;
            box-shadow: 0 6px 15px rgba(0,0,0,0.05);
        }
    </style>
</head>
<body>

<header>
    <h1>Hotel “Nusantara Stay”</h1>
</header>

<div class="container">
    <h2>Daftar Kamar</h2>

    <div class="room-grid">
        @forelse ($kamars as $kamar)
            <div class="room-card">
                <div class="room-title">{{ $kamar->tipe_kamar }}</div>
                <div class="room-price">
                    Rp {{ number_format($kamar->harga_kamar) }} / malam
                </div>

                <div class="room-status">
                    Status:
                    @if ($kamar->status_kamar == 'Tersedia')
                        <span class="status-available">Tersedia</span>
                    @else
                        <span class="status-unavailable">Tidak tersedia</span>
                    @endif
                </div>

                @if ($kamar->status_kamar == 'Tersedia')
                    <a href="{{ route('reservasi.create', $kamar->id_kamar) }}" class="btn">
                        Reservasi
                    </a>
                @endif
            </div>
        @empty
            <div class="empty">
                Data kamar belum tersedia
            </div>
        @endforelse
    </div>
</div>

</body>
</html>

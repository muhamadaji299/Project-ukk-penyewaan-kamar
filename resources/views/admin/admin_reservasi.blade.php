<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Riwayat Reservasi</title>

<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f6f8;
        margin: 0;
    }

    a {
        color: inherit;
        text-decoration: none;
    }

    nav.navbar {
        background-color: #34495e;
        padding: 10px 30px;
        display: flex;
        gap: 15px;
        color: white;
    }

    header {
        background-color: #2c3e50;
        color: white;
        padding: 15px 30px;
    }

    header h1 {
        margin: 0;
        font-size: 22px;
    }

    .container {
        padding: 30px;
    }

    .top-bar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .btn {
        padding: 6px 12px;
        background-color: #3498db;
        color: white;
        border-radius: 4px;
        text-decoration: none;
        border: none;
        cursor: pointer;
        font-size: 14px;
    }

    .btn-warning { background-color: #f39c12; }
    .btn-danger { background-color: #e74c3c; }

    table {
        width: 100%;
        border-collapse: collapse;
        background-color: white;
    }

    th, td {
        border: 1px solid #ddd;
        padding: 10px;
        text-align: center;
    }

    th {
        background-color: #ecf0f1;
        font-weight: bold;
    }

    tr:hover {
        background-color: #f9f9f9;
    }

    form {
        display: inline;
    }

    .action-btns {
        display: flex;
        gap: 5px;
        justify-content: center;
    }

    .search-box {
        margin-bottom: 15px;
        display: flex;
        gap: 5px;
    }

    input[type="text"] {
        padding: 6px;
        border-radius: 4px;
        border: 1px solid #ccc;
    }
</style>
</head>

<body>

<nav class="navbar">
    <a href="{{ route('admin.index') }}">Admin</a>
    <a href="{{ route('admin.reservasi.index') }}">Reservasi Admin</a>
</nav>

<header>
    <h1>Halaman Admin</h1>
</header>

<div class="container">

    <div class="top-bar">
        <div>
            Role: <strong>{{ auth()->user()->name ?? 'Admin' }}</strong>
        </div>

        <div>
            <a href="{{ route('logout') }}" class="btn btn-danger"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Logout
            </a>
        </div>
    </div>

    <form id="logout-form" action="{{ route('logout') }}" method="POST">
        @csrf
    </form>

    <h2>Riwayat Reservasi</h2>

    <form method="GET" class="search-box">
        <input type="text" name="search" placeholder="Cari ID / Nama Tamu">
        <button class="btn">Cari</button>
    </form>

    <table>
        <tr>
            <th>ID Reservasi</th>
            <th>Nama Tamu</th>
            <th>Kamar</th>
            <th>Check In</th>
            <th>Check Out</th>
            <th>Jumlah Tamu</th>
            <th>Total Bayar</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>

        @forelse ($reservasis as $r)
        <tr>
            <td>{{ $r->id_reservasi }}</td>
            <td>{{ $r->nama_tamu }}</td>
            <td>
                {{ $r->kamar->nomor_kamar }}<br>
                <small>{{ $r->kamar->tipe_kamar }}</small>
            </td>
            <td>{{ $r->check_in }}</td>
            <td>{{ $r->check_out }}</td>
            <td>{{ $r->jumlah_tamu }}</td>
            <td>Rp {{ number_format($r->total_bayar) }}</td>
            <td>{{ $r->status_reservasi }}</td>
            <td class="action-btns">
                @if ($r->status_reservasi == 'Booking')
                    <form method="POST" action="{{ route('admin.reservasi.update', $r->id_reservasi) }}">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="status_reservasi" value="Check-in">
                        <button class="btn btn-warning">Check-in</button>
                    </form>

                    <form method="POST" action="{{ route('admin.reservasi.update', $r->id_reservasi) }}">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="status_reservasi" value="Batal">
                        <button class="btn btn-danger">Batal</button>
                    </form>

                @elseif ($r->status_reservasi == 'Check-in')
                    <form method="POST" action="{{ route('admin.reservasi.update', $r->id_reservasi) }}">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="status_reservasi" value="Selesai">
                        <button class="btn">Selesai</button>
                    </form>
                @else
                    -
                @endif
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="8">Data reservasi belum ada</td>
        </tr>
        @endforelse
    </table>

</div>

</body>
</html>

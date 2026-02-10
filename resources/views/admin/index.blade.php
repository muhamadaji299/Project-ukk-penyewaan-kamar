<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Reservasi</title>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f6f8;
        margin: 0;
    }

    a{
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

    <h2>Data Kamar</h2>

   <form method="GET" style="display: flex; gap: 10px; margin-bottom: 15px;">
    
    {{-- Dropdown Tipe Kamar --}}
    <select name="tipe_kamar">
        <option value="">-- Semua Tipe Kamar --</option>
        @foreach ($tipeKamars as $tipe)
            <option value="{{ $tipe }}"
                {{ request('tipe_kamar') == $tipe ? 'selected' : '' }}>
                {{ $tipe }}
            </option>
        @endforeach
    </select>

    {{-- Dropdown Status Kamar --}}
    <select name="status_kamar">
        <option value="">-- Semua Status --</option>
        @foreach ($statusKamars as $status)
            <option value="{{ $status }}"
                {{ request('status_kamar') == $status ? 'selected' : '' }}>
                {{ $status }}
            </option>
        @endforeach
    </select>

    <button class="btn">Filter</button>
</form>


    <a href="{{ route('admin.create') }}" class="btn">+ Tambah Kamar</a>

    <br><br>

    <table>
        <tr>
            <th>ID Kamar</th>
            <th>Nomor Kamar</th>
            <th>Tipe Kamar</th>
            <th>Harga</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>

        @forelse ($kamars as $k)
        <tr>
            <td>{{ $k->id_kamar }}</td>
            <td>{{ $k->nomor_kamar }}</td>
            <td>{{ $k->tipe_kamar }}</td>
            <td>Rp {{ number_format($k->harga_kamar) }}</td>
            <td>{{ $k->status_kamar }}</td>
            <td class="action-btns">
                <a href="{{ route('admin.edit', $k->id_kamar) }}" class="btn btn-warning">Edit</a>

                <form action="{{ route('admin.destroy', $k->id_kamar) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger"
                        onclick="return confirm('Yakin ingin menghapus data ini?')">
                        Hapus
                    </button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="6">Data kamar belum tersedia</td>
        </tr>
        @endforelse
    </table>

</div>

</body>
</html>
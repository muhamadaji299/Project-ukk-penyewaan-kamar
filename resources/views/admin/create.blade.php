<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kamar</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f8;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #2c3e50;
            color: white;
            padding: 15px 30px;
        }

        .container {
            padding: 30px;
            max-width: 600px;
            margin: auto;
            background-color: white;
            border-radius: 6px;
        }

        h2 {
            margin-bottom: 20px;
            text-align: center;
        }

        label {
            display: block;
            margin-top: 10px;
            font-weight: bold;
        }

        input, select {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }

        .btn {
            padding: 10px 16px;
            background-color: #3498db;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            border: none;
            cursor: pointer;
        }

        .btn-secondary {
            background-color: #7f8c8d;
        }

        .btn-group {
            margin-top: 20px;
            display: flex;
            justify-content: space-between;
        }
    </style>
</head>
<body>

<header>
    <h1>Halaman Admin</h1>
</header>

<div class="container">
    <h2>Tambah Data Kamar</h2>

    <form action="{{ route('admin.store') }}" method="POST">
        @csrf

        <label>Id Kamar</label>
        <input type="text" name="id_kamar" required>

        <label>Nomor Kamar</label>
        <input type="text" name="nomor_kamar" required>

        <label>Tipe Kamar</label>
        <select name="tipe_kamar" required>
            <option value="">-- Pilih --</option>
            <option value="Standard">Standard</option>
            <option value="Deluxe">Deluxe</option>
            <option value="Suite">Suite</option>
        </select>

        <label>Harga Kamar</label>
        <input type="number" name="harga_kamar" required>

        <label>Status Kamar</label>
        <select name="status_kamar" required>
            <option value="Tersedia">Tersedia</option>
            <option value="Tidak Tersedia">Tidak Tersedia</option>
        </select>

        <div class="btn-group">
            <a href="{{ route('admin.index') }}" class="btn btn-secondary">Kembali</a>
            <button type="submit" class="btn">Simpan</button>
        </div>
    </form>
</div>

</body>
</html>

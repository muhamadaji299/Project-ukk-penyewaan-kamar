<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Reservasi</title>

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
            max-width: 560px;
            margin: 40px auto;
            background-color: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.08);
        }

        .form-group {
            margin-bottom: 18px;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-size: 14px;
            font-weight: 600;
            color: #2c3e50;
        }

        input {
            width: 100%;
            padding: 10px 12px;
            border-radius: 8px;
            border: 1px solid #dcdde1;
            font-size: 14px;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }

        input:focus {
            outline: none;
            border-color: #3498db;
            box-shadow: 0 0 0 3px rgba(52,152,219,0.15);
        }

        input[readonly] {
            background-color: #f1f3f6;
            color: #555;
        }

        .btn {
            margin-top: 10px;
            width: 100%;
            padding: 12px;
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s ease, transform 0.1s ease;
        }

        .btn:hover {
            background-color: #2980b9;
        }

        .btn:active {
            transform: scale(0.98);
        }

        .error-box {
            max-width: 560px;
            margin: 30px auto 0;
            background-color: #f8d7da;
            color: #721c24;
            padding: 15px 20px;
            border-radius: 10px;
            box-shadow: 0 6px 15px rgba(0,0,0,0.05);
        }

        .error-box ul {
            margin: 0;
            padding-left: 18px;
            font-size: 14px;
        }
    </style>
</head>
<body>

@if ($errors->any())
    <div class="error-box">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<header>
    <h1>Form Reservasi</h1>
</header>

<div class="container">
    <form action="{{ route('reservasi.store') }}" method="POST">
        @csrf

        <input type="hidden" name="id_kamar" value="{{ $kamar->id_kamar }}">

        <div class="form-group">
            <label>Tipe Kamar</label>
            <input type="text" value="{{ $kamar->tipe_kamar }}" readonly>
        </div>

        <div class="form-group">
            <label>Nama Tamu</label>
            <input type="text" name="nama_tamu" required>
        </div>

        <div class="form-group">
            <label>No HP</label>
            <input type="text" name="no_hp" required>
        </div>

        <div class="form-group">
            <label>Check In</label>
            <input type="date" name="check_in" required>
        </div>

        <div class="form-group">
            <label>Check Out</label>
            <input type="date" name="check_out" required>
        </div>

        <div class="form-group">
            <label>Jumlah Tamu</label>
            <input type="number" name="jumlah_tamu" required>
        </div>

        <input type="hidden" id="harga_kamar" value="{{ $kamar->harga_kamar }}">


        <div class="form-group">
    <label>Ringkasan Biaya</label>
    <input type="text" id="total_bayar" readonly value="Rp 0">
</div>


        <a href="{{ route('reservasi.index')}}">Kembali</a>
        <button type="submit" class="btn">Simpan Reservasi</button>
    </form>
</div>

<script>
    const checkInInput  = document.querySelector('input[name="check_in"]');
    const checkOutInput = document.querySelector('input[name="check_out"]');
    const hargaKamar    = document.getElementById('harga_kamar').value;
    const totalBayarEl  = document.getElementById('total_bayar');

    function hitungTotal() {
        const checkIn  = new Date(checkInInput.value);
        const checkOut = new Date(checkOutInput.value);

        if (checkIn && checkOut && checkOut > checkIn) {
            const diffTime  = checkOut - checkIn;
            const lamaInap  = diffTime / (1000 * 60 * 60 * 24);
            const total     = lamaInap * hargaKamar;

            totalBayarEl.value = 'Rp ' + total.toLocaleString('id-ID');
        } else {
            totalBayarEl.value = 'Rp 0';
        }
    }

    checkInInput.addEventListener('change', hitungTotal);
    checkOutInput.addEventListener('change', hitungTotal);
</script>


</body>
</html>

<?php

namespace App\Http\Controllers;
use App\Models\Kamar;
use App\Models\Reservasi;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReservasiPelangganController extends Controller
{


public function index()
{
    $kamars = Kamar::where('status_kamar', 'Tersedia')->get();
    return view('reservasi.index', compact('kamars'));
}

public function create($id_kamar)
{
    $kamar = Kamar::where('id_kamar', $id_kamar)
                  ->where('status_kamar', 'Tersedia')
                  ->firstOrFail();

    return view('reservasi.create', compact('kamar'));
}



public function store(Request $request)
{


    $request->validate([
        'id_kamar'  => 'required|exists:kamars,id_kamar',
        'nama_tamu' => 'required|string',
        'no_hp'     => 'required|string',
        'jumlah_tamu' => 'required|integer|min:1',
        'check_in'  => 'required|date',
        'check_out' => 'required|date|after:check_in',
    ], [
        'check_out.after' => 'Tanggal check-out harus lebih besar dari tanggal check-in',
    ]);

    $kamar = Kamar::findOrFail($request->id_kamar);

    $checkIn  = Carbon::parse($request->check_in);
    $checkOut = Carbon::parse($request->check_out);

    $lamaMenginap = $checkIn->diffInDays($checkOut);
    $totalBayar = $lamaMenginap * $kamar->harga_kamar;

    Reservasi::create([
        'id_kamar'         => $kamar->id_kamar,
        'nama_tamu'        => $request->nama_tamu,
        'no_hp'            => $request->no_hp,
        'check_in'         => $request->check_in,
        'check_out'        => $request->check_out,
        'jumlah_tamu'      => $request->jumlah_tamu,
        'total_bayar'      => $totalBayar,
        'status_reservasi' => 'Booking'
    ]);

    $kamar->update([
        'status_kamar' => 'Tidak Tersedia'
    ]);

    return redirect()
        ->route('reservasi.index')
        ->with('success', 'Reservasi berhasil');
}



}

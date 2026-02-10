<?php

namespace App\Http\Controllers;
use App\Models\Reservasi;
use App\Models\Kamar;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class AdminReservasiController extends Controller
{

    public function index(Request $request)
    {
        $query = Reservasi::with('kamar');

        if ($request->filled('search')) {
            $query->where('id_reservasi', $request->search)
                  ->orWhere('nama_tamu', 'like', '%' . $request->search . '%');
        }

        $reservasis = $query->orderBy('created_at', 'desc')->get();

        return view('admin.admin_reservasi', compact('reservasis'));
    }

    public function updateStatus(Request $request, $id)
    {
        $reservasi = Reservasi::with('kamar')->findOrFail($id);
        $statusBaru = $request->status_reservasi;

        $reservasi->update([
            'status_reservasi' => $statusBaru
        ]);

        // LOGIKA PENGEMBALIAN STATUS KAMAR
        if (in_array($statusBaru, ['Selesai', 'Batal'])) {
            $reservasi->kamar->update([
                'status_kamar' => 'Tersedia'
            ]);
        }

        return redirect()->back()->with('success', 'Status berhasil diubah');
    }
}

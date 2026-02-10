<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kamar;
use Illuminate\Validation\Rule;

use function PHPUnit\Framework\returnArgument;

class AdminController extends Controller
{

  public function index(Request $request)
{
    // data dropdown (unik)
    $tipeKamars = Kamar::select('tipe_kamar')->distinct()->pluck('tipe_kamar');
    $statusKamars = Kamar::select('status_kamar')->distinct()->pluck('status_kamar');

    // query utama
    $query = Kamar::query();

    if ($request->filled('tipe_kamar')) {
        $query->where('tipe_kamar', $request->tipe_kamar);
    }

    if ($request->filled('status_kamar')) {
        $query->where('status_kamar', $request->status_kamar);
    }

    $kamars = $query->get();

    return view('admin.index', compact(
        'kamars',
        'tipeKamars',
        'statusKamars'
    ));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_kamar' => 'required|string|unique:kamars,id_kamar',
            'nomor_kamar' => 'required|string|unique:kamars,nomor_kamar',
            'tipe_kamar' => 'required|in:Standard,Deluxe,Suite',
            'harga_kamar' => 'required|integer',
            'status_kamar' => 'required|in:Tersedia,Tidak Tersedia',
        ]);

        Kamar::create([
            'id_kamar' => $request->id_kamar,
            'nomor_kamar' => $request->nomor_kamar,
            'tipe_kamar' => $request->tipe_kamar,
            'harga_kamar' => $request->harga_kamar,
            'status_kamar' => $request->status_kamar,
        ]);

        return redirect()->route('admin.index')->with('success', 'Kamar berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */

    public function show(string $id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
   public function edit(string $id_kamar)
{
    $kamar = Kamar::findOrFail($id_kamar);
    return view('admin.edit', compact('kamar'));
}



    /**
     * Update the specified resource in storage.
     */
   
public function update(Request $request, string $id_kamar)
{
    $request->validate([
        'id_kamar' => [
            'required',
            Rule::unique('kamars')->ignore($id_kamar, 'id_kamar'),
        ],
        'nomor_kamar' => [
            'required',
            Rule::unique('kamars')->ignore($id_kamar, 'id_kamar'),
        ],
        'tipe_kamar'   => 'required|in:Standard,Deluxe,Suite',
        'harga_kamar'  => 'required|integer',
        'status_kamar' => 'required|in:Tersedia,Tidak Tersedia',
    ]);

    $kamar = Kamar::findOrFail($id_kamar);

    $kamar->update($request->all());

    return redirect()
        ->route('admin.index')
        ->with('success', 'Kamar berhasil diupdate!');
}



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kamar = Kamar::findOrFail($id);
        $kamar->delete();

        return redirect()->route('admin.index')->with('success', 'Kamar berhasil dihapus!');
    }
}

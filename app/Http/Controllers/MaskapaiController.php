<?php

namespace App\Http\Controllers;

use App\Models\seat;
use App\Models\maskapai;
use Illuminate\Http\Request;

class MaskapaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $maskapais = maskapai::all();
        $maskapai = null;

        return view('admin.maskapai', compact('maskapais', 'maskapai'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_pesawat' => 'required|unique:maskapais',
            'nama_maskapai' => 'required',
            'nama_pesawat' => 'required',
            'jenis_pesawat' => 'required',
            'jumlah_kursi' => 'required|numeric',
            'kursi_perbaris' => 'required|numeric'
        ]);

        $maskapai = maskapai::create($request->all());

        $jumlah_bangku = (int)$request->jumlah_kursi;
        $kursi_perbaris = (int)$request->kursi_perbaris;
        $total_bangku = 0;

        $baris = 1;
        while ($total_bangku < $jumlah_bangku) {
            for ($kolom = 1; $kolom <= $kursi_perbaris; $kolom++) {
                if ($total_bangku >= $jumlah_bangku) {
                    break;
                }

                $bangku_code = $baris . chr(64 + $kolom);


                seat::create([
                    'id_pesawat' => $maskapai->id_pesawat,
                    'bangku_code' => $bangku_code
                ]);

                $total_bangku++;
            }
            $baris++;
        }

        return redirect()->route('maskapai.index')
            ->with('success', 'Data Maskapai berhasil dibuat dengan ' . $total_bangku . ' kursi');
    }

    /**
     * Display the specified resource.
     */
    public function show(maskapai $maskapai)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(maskapai $maskapai)
    {
        $maskapais = Maskapai::all();
        return view('admin.maskapai', compact('maskapais', 'maskapai'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, maskapai $maskapai)
    {
        $request->validate([
            'id_pesawat' => 'required|unique:maskapais,id_pesawat,' . $maskapai->id,
            'nama_maskapai' => 'required',
            'nama_pesawat' => 'required',
            'jenis_pesawat' => 'required',
            'jumlah_kursi' => 'required|numeric',
            'kursi_perbaris' => 'required|numeric'
        ]);

        $maskapai->update($request->all());
        return redirect()->route('maskapai.index')->with('success', 'Data Maskapai berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(maskapai $maskapai)
    {
        $maskapai->delete();
        return redirect()->route('maskapai.index')->with('success', 'Data Maskapai berhasil dihapus' );
    }
}

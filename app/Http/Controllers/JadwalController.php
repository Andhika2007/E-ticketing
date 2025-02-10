<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Maskapai;
use App\Models\Bandara;
use Illuminate\Http\Request;
use Carbon\Carbon;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jadwals = Jadwal::with(['maskapai', 'bandaraKeberangkatan', 'bandaraTujuan'])->get();
        $maskapais = Maskapai::all();
        $bandaras = Bandara::all();

        return view('admin.jadwal', compact('jadwals', 'maskapais', 'bandaras'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $maskapais = Maskapai::all();
        $bandaras = Bandara::all();
        return view('admin.jadwal.create', compact('maskapais', 'bandaras'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'no_penerbangan' => 'required|unique:jadwal',
            'id_pesawat' => 'required',
            'keberangkatan' => 'required',
            'tujuan' => 'required',
            'date' => 'required|date|after_or_equal:today',
            'boarding_time' => 'required',
            'harga' => 'required|numeric|min:0',
            'gerbang' => 'required'
        ]);


        Jadwal::create($request->all());

        return redirect()
            ->route('jadwal.index')
            ->with('success', 'Jadwal penerbangan berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Jadwal $jadwal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Jadwal $jadwal)
    {
        $maskapais = Maskapai::all();
        $bandaras = Bandara::all();
        $jadwals = Jadwal::all();

        return view('admin.jadwal', compact('jadwal', 'maskapais', 'bandaras', 'jadwals'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Jadwal $jadwal)
    {
        $request->validate([
            'no_penerbangan' => 'required|unique:jadwal',
            'id_pesawat' => 'required',
            'keberangkatan' => 'required',
            'tujuan' => 'required',
            'date' => 'required|date|after_or_equal:today',
            'boarding_time' => 'required',
            'harga' => 'required|numeric|min:0',
            'gerbang' => 'required'
        ]);

        $jadwal->update($request->all());

        return redirect()->route('jadwal.index')
            ->with('success', 'Jadwal berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jadwal $jadwal)
    {
        $jadwal->delete();
        return redirect()->route('jadwal.index')
            ->with('success', 'Jadwal berhasil dihapus');
    }
}

<?php

namespace App\Http\Controllers;


use App\Models\bandara;
use Illuminate\Http\Request;

class BandaraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bandaras = bandara::all();
        $bandara = null;
        return view('admin.bandara', compact('bandaras', 'bandara'));
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
            'id_bandara' => 'required|unique:bandaras',
            'nama_bandara' => 'required',
            'kota' => 'required',
            'negara' => 'required'
        ]);

        bandara::create($request->all());

        return redirect()->route('bandara.index')
            ->with('success', 'Data Bandara berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(bandara $bandara)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(bandara $bandara)
    {
        $bandaras = bandara::all();
        return view('admin.bandara', compact('bandara', 'bandaras'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, bandara $bandara)
    {
        $request->validate([
            'id_bandara' => 'required|unique:bandaras,id_bandara,' . $bandara->id,
            'nama_bandara' => 'required',
            'kota' => 'required',
            'negara' => 'required'
        ]);

        $bandara->update($request->all());
        return  redirect()->route('bandara.index')->with('success', 'Data Bandara berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(bandara $bandara)
    {
        $bandara->delete();
        return  redirect()->route('bandara.index')->with('success', 'Data Bandara berhasil dihapus');
    }
}

<?php

namespace App\Http\Controllers;

use App\Penjualan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Penjualan::all();
        return view('welcome', compact('data')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
{
    $data = Penjualan::all();
    $request->validate([
        'nama_barang' => 'required',
        'stok' => 'required|integer|min:0',
        'jumlah_terjual' => 'required|integer|min:0',
        'tanggal_transaksi' => 'required|date',
        'jenis_barang' => 'required',
    ]);

    $input = $request->all();$penjualan = penjualan::create($input);

        return redirect('/penjualan')->with('success', 'Data transaksi Berhasih ditambahkan.');

    $result = DB::table('penjualan')->insert([
        'nama_barang' => $request->input('nama_barang'),
        'stok' => $request->input('stok'),
        'jumlah_terjual' => $request->input('jumlah_terjual'),
        'tanggal_transaksi' => $request->input('tanggal_transaksi'),
        'jenis_barang' => $request->input('jenis_barang'),
    ]);

    

    if ($result) {
        return "Data berhasil ditambahkan.";
    } else {
        return "Gagal menambahkan data.";
    }
}

    /**
     * Display the specified resource.
     *
     * @param  \App\Penjualan  $penjualan
     * @return \Illuminate\Http\Response
     */
    public function show(Penjualan $penjualan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Penjualan  $penjualan
     * @return \Illuminate\Http\Response
     */
    public function edit(Penjualan $penjualan)
    {
        return view('edit_penjualan', compact('penjualan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Penjualan  $penjualan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Penjualan $penjualan)
    {
        $request->validate([
            'nama_barang' => 'required',
            'stok' => 'required|integer|min:0',
            'jumlah_terjual' => 'required|integer|min:0',
            'tanggal_transaksi' => 'required|date',
            'jenis_barang' => 'required',
        ]);

        $penjualan->update($request->all());

        return redirect()->route('penjualan.index')->with('success', 'Data berhasil diupdate.');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Penjualan  $penjualan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Penjualan $penjualan)
    {
        $penjualan->delete();

        return redirect()->route('penjualan.index')->with('success', 'Data berhasil dihapus.');
    }
}

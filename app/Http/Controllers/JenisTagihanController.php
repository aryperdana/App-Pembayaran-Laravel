<?php

namespace App\Http\Controllers;

use App\Models\JenisTagihan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JenisTagihanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $key = $request->key;
        $jenis_tagihan = JenisTagihan
            ::where('nama_jenis_tagihan', 'LIKE', '%' . $key . '%')
            ->orWhere('keterangan', 'LIKE', '%' . $key . '%')
            ->paginate(10);
        return view('pages.jenis_tagihan.jenis_tagihan')->with([
            'user' => Auth::user(),
            'data' => $jenis_tagihan,
        ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.jenis_tagihan.tambah_jenis_tagihan')->with([
            'user' => Auth::user(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'nama_jenis_tagihan' => 'required'
        ]);



        $jenis_tagihan = new JenisTagihan;
        $jenis_tagihan->nama_jenis_tagihan = $request->nama_jenis_tagihan;
        $jenis_tagihan->no_akun = $request->no_akun;
        $jenis_tagihan->nama_akun = $request->nama_akun;
        $jenis_tagihan->keterangan = $request->keterangan;
        $jenis_tagihan->save();

        return to_route('jenis-tagihan.index')->with('success', 'Data Berhasil Di Tambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\JenisTagihan  $jenisTagihan
     * @return \Illuminate\Http\Response
     */
    public function show(JenisTagihan $jenisTagihan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\JenisTagihan  $jenisTagihan
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('pages.jenis_tagihan.ubah_jenis_tagihan')->with([
            'user' => Auth::user(),
            'data' => JenisTagihan::find($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\JenisTagihan  $jenisTagihan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_jenis_tagihan' => 'required',
        ]);


        $jenis_tagihan = JenisTagihan::find($id);
        $jenis_tagihan->nama_jenis_tagihan = $request->nama_jenis_tagihan;
        $jenis_tagihan->keterangan = $request->keterangan;
        $jenis_tagihan->save();

        return to_route('jenis-tagihan.index')->with('success', 'Data Berhasil Di Ubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\JenisTagihan  $jenisTagihan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jenis_tagihan = JenisTagihan::find($id);
        $jenis_tagihan->delete();
        return back()->with('success', 'Data Berhasil Di Hapus');
    }
}

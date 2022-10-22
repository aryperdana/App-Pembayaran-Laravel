<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\WaliMurid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WaliMuridController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $key = $request->key;
        $wali_murid = WaliMurid
            ::with('siswa')
            ->where('nama_wali', 'LIKE', '%' . $key . '%')
            ->orWhere('no_telp', 'LIKE', '%' . $key . '%')
            ->orWhere('id_siswa', 'LIKE', '%' . $key . '%')
            ->paginate(10);
        return view('pages.wali_murid.wali_murid')->with([
            'user' => Auth::user(),
            'data' => $wali_murid,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $siswas = Siswa::all();
        return view('pages.wali_murid.tambah_wali_murid')->with([
            'user' => Auth::user(),
            'data' => $siswas
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
            'no_telp' => 'required',
            'nama_wali' => 'required|min:3',
            'id_siswa' => 'required',
        ]);



        $wali_murid = new WaliMurid;
        $wali_murid->id_siswa = $request->id_siswa;
        $wali_murid->no_telp = $request->no_telp;
        $wali_murid->nama_wali = $request->nama_wali;
        $wali_murid->save();

        return to_route('wali-murid.index')->with('success', 'Data Berhasil Di Tambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\WaliMurid  $waliMurid
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('pages.wali_murid.ubah_wali_murid')->with([
            'user' => Auth::user(),
            'data' => WaliMurid::find($id),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\WaliMurid  $waliMurid
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $siswas = Siswa::all();
        return view('pages.wali_murid.ubah_wali_murid')->with([
            'user' => Auth::user(),
            'data' => WaliMurid::find($id),
            'siswa' => $siswas,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\WaliMurid  $waliMurid
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'no_telp' => 'required',
            'nama_wali' => 'required|min:3',
            'id_siswa' => 'required',
        ]);

        $wali_murid = WaliMurid::find($id);
        $wali_murid->id_siswa = $request->id_siswa;
        $wali_murid->no_telp = $request->no_telp;
        $wali_murid->nama_wali = $request->nama_wali;
        $wali_murid->save();

        return to_route('wali-murid.index')->with('success', 'Data Berhasil Di Ubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\WaliMurid  $waliMurid
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $wali_murid = WaliMurid::find($id);
        $wali_murid->delete();
        return back()->with('success', 'Data Berhasil Di Hapus');
    }
}

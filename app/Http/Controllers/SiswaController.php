<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiswaController extends Controller
{
    public function index(Request $request)
    {
        $key = $request->key;
        $siswa = Siswa
            ::where('nama_siswa', 'LIKE', '%' . $key . '%')
            ->orWhere('no_telp', 'LIKE', '%' . $key . '%')
            ->orWhere('email', 'LIKE', '%' . $key . '%')
            ->paginate(10);
        return view('pages.siswa.siswa')->with([
            'user' => Auth::user(),
            'data' => $siswa,
        ]);
    }

    public function getSiswaAll()
    {
        //
        $siswa = Siswa::get();
        return response()->json([
            'message' => 'success',
            'siswa' => $siswa
        ], 200);
    }

    public function create()
    {
        return view('pages.siswa.tambah_siswa')->with([
            'user' => Auth::user(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'no_telp' => 'required',
            'nis' => 'required',
            'nama_siswa' => 'required|min:3',
            'email' => 'required|min:3',
        ]);

        $siswa = new Siswa;
        $siswa->nis = $request->nis;
        $siswa->no_telp = $request->no_telp;
        $siswa->nama_siswa = $request->nama_siswa;
        $siswa->email = $request->email;
        $siswa->save();

        return to_route('siswa.index')->with('success', 'Data Berhasil Di Tambah');
    }

    public function edit($id)
    {
        return view('pages.siswa.ubah_siswa')->with([
            'user' => Auth::user(),
            'data' => Siswa::find($id),
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'no_telp' => 'required',
            'nama_siswa' => 'required|min:3',
            'email' => 'required|min:3',
        ]);

        $siswa = Siswa::find($id);
        $siswa->no_telp = $request->no_telp;
        $siswa->nama_siswa = $request->nama_siswa;
        $siswa->email = $request->email;
        $siswa->save();

        return to_route('siswa.index')->with('success', 'Data Berhasil Di Ubah');
    }

    public function destroy($id)
    {
        $siswa = Siswa::find($id);
        $siswa->delete();
        return back()->with('success', 'Data Berhasil Di Hapus');
    }
}

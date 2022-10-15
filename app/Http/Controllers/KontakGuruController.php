<?php

namespace App\Http\Controllers;

use App\Models\KontakGuru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KontakGuruController extends Controller
{
    public function index(Request $request)
    {
        $key = $request->key;
        $kontak_guru = KontakGuru
            ::where('nama_guru', 'LIKE', '%' . $key . '%')
            ->orWhere('nip', 'LIKE', '%' . $key . '%')
            ->orWhere('jabatan', 'LIKE', '%' . $key . '%')
            ->paginate(10);
        return view('pages.kontak_guru.kontak_guru')->with([
            'user' => Auth::user(),
            'data' => $kontak_guru,
        ]);
    }

    public function create()
    {
        return view('pages.kontak_guru.tambah_kontak_guru')->with([
            'user' => Auth::user(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nip' => 'required|min:5|max:5',
            'nama_guru' => 'required|min:3',
            'jabatan' => 'required|min:3',
        ]);

        $kontak_guru = new KontakGuru;
        $kontak_guru->nip = $request->nip;
        $kontak_guru->nama_guru = $request->nama_guru;
        $kontak_guru->jabatan = $request->jabatan;
        $kontak_guru->save();

        return to_route('kontak-guru.index')->with('success', 'Data Berhasil Di Tambah');
    }

    public function edit($id)
    {
        return view('pages.kontak_guru.ubah_kontak_guru')->with([
            'user' => Auth::user(),
            'data' => KontakGuru::find($id),
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nip' => 'required|min:5|max:5',
            'nama_guru' => 'required|min:3',
            'jabatan' => 'required|min:3',
        ]);

        $kontak_guru = KontakGuru::find($id);
        $kontak_guru->nip = $request->nip;
        $kontak_guru->nama_guru = $request->nama_guru;
        $kontak_guru->jabatan = $request->jabatan;
        $kontak_guru->save();

        return to_route('kontak-guru.index')->with('success', 'Data Berhasil Di Ubah');
    }

    public function destroy($id)
    {
        $kontak_guru = KontakGuru::find($id);
        $kontak_guru->delete();
        return back()->with('success', 'Data Berhasil Di Hapus');
    }
}

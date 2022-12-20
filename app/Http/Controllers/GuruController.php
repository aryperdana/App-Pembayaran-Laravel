<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class GuruController extends Controller
{
    public function index(Request $request)
    {
        $key = $request->key;
        $guru = Guru
            ::where('nama_guru', 'LIKE', '%' . $key . '%')
            ->orWhere('no_telp', 'LIKE', '%' . $key . '%')
            ->orWhere('jabatan', 'LIKE', '%' . $key . '%')
            ->paginate(10);
        return view('pages.guru.guru')->with([
            'user' => Auth::user(),
            'data' => $guru,
        ]);
    }

    public function create()
    {
        return view('pages.guru.tambah_guru')->with([
            'user' => Auth::user(),
        ]);
    }

    public function store(Request $request)
    {

        $request->validate([
            'nama_guru' => 'required',
            'no_telp' => 'required',
            'jabatan' => 'required',
            'path_foto' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
            'nip' => 'required',
        ]);

        if ($request->hasFile('path_foto')) {
            $image = $request->file('path_foto')->store('uploads');
        } else {
            $image = '';
        }

        $guru = new Guru;
        $guru->no_telp = $request->no_telp;
        $guru->nama_guru = $request->nama_guru;
        $guru->jabatan = $request->jabatan;
        $guru->nip = $request->nip;
        $guru->path_foto = $image;
        $guru->save();

        return to_route('guru.index')->with('success', 'Data Berhasil Di Tambah');
    }

    public function edit($id)
    {
        return view('pages.guru.ubah_guru')->with([
            'user' => Auth::user(),
            'data' => Guru::find($id),
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_guru' => 'required',
            'no_telp' => 'required',
            'jabatan' => 'required',
            'path_foto' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('path_foto')) {
            $image = $request->file('path_foto')->store('uploads');
        } else {
            $image = '';
        }

        $guru = Guru::find($id);
        $path = $guru->path_foto;

        if ($path != null || $path != '') {
            Storage::delete($path);
        }

        $guru->no_telp = $request->no_telp;
        $guru->nama_guru = $request->nama_guru;
        $guru->jabatan = $request->jabatan;
        $guru->path_foto = $image;
        $guru->save();

        return to_route('guru.index')->with('success', 'Data Berhasil Di Ubah');
    }

    public function destroy($id)
    {
        $guru = Guru::find($id);
        $path = $guru->path_foto;

        if ($path != null || $path != '') {
            Storage::delete($path);
        }

        $guru->delete();
        return back()->with('success', 'Data Berhasil Di Hapus');
    }
}

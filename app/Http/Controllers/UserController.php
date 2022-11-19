<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {

        $key = $request->key;
        $user = User::where('name', 'LIKE', '%' . $key . '%')
            ->orWhere('username', 'LIKE', '%' . $key . '%')
            ->orWhere('email', 'LIKE', '%' . $key . '%')->paginate(10);
        return view('pages.user.user')->with([
            'user' => Auth::user(),
            'data' => $user
        ]);
    }

    public function create()
    {
        $siswa = Siswa::all();
        return view('pages.user.tambah_user')->with([
            'user' => Auth::user(),
            'data' => $siswa,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'username' => 'required',
            'password' => 'required',
            'level' => 'required',
            'id_siswa' => 'required',
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->level = $request->level;
        $user->id_siswa = $request->id_siswa;
        $user->save();

        return to_route('user.index')->with('success', 'Data Berhasil Di Tambah');
    }

    public function edit($id)
    {
        return view('pages.user.ubah_user')->with([
            'user' => Auth::user(),
            'data' => User::find($id),
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'username' => 'required',
            'password' => 'required',
            'level' => 'required',
        ]);


        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->level = $request->level;
        $user->save();

        return to_route('user.index')->with('success', 'Data Berhasil Di Ubah');
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return back()->with('success', 'Data Berhasil Di Hapus');
    }
}

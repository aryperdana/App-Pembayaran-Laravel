<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Guru;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {

        $key = $request->key;
        $auth = Auth::user();
        if ($auth->level == '1') {
            $user = User::where('name', 'LIKE', '%' . $key . '%')
            ->orWhere('username', 'LIKE', '%' . $key . '%')
            ->orWhere('email', 'LIKE', '%' . $key . '%')->paginate(10);
        }  
        if ($auth->level == "2") {
            $user = User::where('id_guru', $auth->id_guru)->paginate(10);
            // dd($auth->id_guru);
        }
        if ($auth->level == "3") {
            $user = User::where('id_siswa', $auth->id_siswa)->paginate(10);
            // dd($auth->id_guru);
        }
        return view('pages.user.user')->with([
            'user' => Auth::user(),
            'data' => $user
        ]);
    }

    public function create()
    {
        $siswa = Siswa::all();
        $guru = Guru::all();
        return view('pages.user.tambah_user')->with([
            'user' => Auth::user(),
            'data' => $siswa,
            'data_guru' => $guru,
        ]);
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|confirmed',
        ],
        [
            'password.confirmed' => 'Password Yang Dimasukan Tidak Sama!',
        ]);

        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->password)
        ]);

        return back()->with("status", "Password berhasil diubah!");
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'username' => 'required',
            'password' => 'required',
            'level' => 'required',
        ]);

        
        if ($request->id_guru != "none") {
            $saving_guru = $request->id_guru;
        } else {
            $saving_guru = 0;
        }

        if ($request->id_siswa != "none") {
            $saving_murid = $request->id_siswa;
        } else {
            $saving_murid = 0;
        }

        
        

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->level = $request->level;
        $user->id_siswa = $saving_murid;
        $user->id_guru = $saving_guru;
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

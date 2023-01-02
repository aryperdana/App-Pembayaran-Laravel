<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\User;
use App\Models\Guru;
use App\Models\DetailTagihanSPP;
use Illuminate\Support\Facades\Auth;

class LayoutController extends Controller
{
    public function index()
    {
        $siswa = Siswa::with("detailTagihanSPP")->get();
        $user = Auth::user();
        $guru = Guru::where("id", $user->id_guru)->get();
        $jumlahTunggakan = DetailTagihanSPP::where("status_pembayaran", 0)->count();
        $jumlahUser = User::all()->count();
        $jumlahSiswa = Siswa::all()->count();
        return view('layout.home')->with([
            'user' => $user,
            'siswa' => $siswa,
            'guru' => $guru,
            'jumlah_siswa' => $jumlahSiswa, 
            'jumlah_user' => $jumlahUser,
            'jumlah_tunggakan' => $jumlahTunggakan,
        ]);
    }
}

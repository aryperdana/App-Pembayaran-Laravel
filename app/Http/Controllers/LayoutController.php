<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LayoutController extends Controller
{
    public function index()
    {
        $siswa = Siswa::with("detailTagihanSPP")->get();
        $jumlahUser = User::all()->count();
        $jumlahSiswa = Siswa::all()->count();
        return view('layout.home')->with([
            'user' => Auth::user(),
            'siswa' => $siswa,
            'jumlah_siswa' => $jumlahSiswa, 
            'jumlah_user' => $jumlahUser,
        ]);
    }
}

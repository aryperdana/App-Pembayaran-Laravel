<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\User;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\DetailKelas;
use App\Models\DetailTagihanSPP;
use Illuminate\Support\Facades\Auth;

class LayoutController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        

        if ($user->level == 1) {
            $siswa = Siswa::with("detailTagihanSPP")->get();
        }

        if ($user->level == 2) {
            $kelas = Kelas::where("id_guru", Auth::user()->id_guru)->get();
            $detailKelas = DetailKelas::where("id_kelas", $kelas[0]->id)->get();
            $subset = $detailKelas->map(function ($detailKelas) {
                return $detailKelas->id_siswa;
            });
            $siswa = Siswa::with("detailTagihanSPP")->whereIn("id", $subset)->get();
        }

        if ($user->level == 3) {
            $siswa = Siswa::with("detailTagihanSPP")->get();
        }
        
        $guru = Guru::where("id", $user->id_guru)->get();
        $siswaByID = Siswa::with("detail_kelass")->where("id", $user->id_siswa)->get();
        $jumlahTunggakan = DetailTagihanSPP::where("status_pembayaran", 0)->count();
        $jumlahTunggakanSiswa = DetailTagihanSPP::where("status_pembayaran", 0)->where("id_siswa", $user->id_siswa)->count();
        // dd($jumlahTunggakanSiswa);
        $jumlahUser = User::all()->count();
        $jumlahSiswa = Siswa::all()->count();
        return view('layout.home')->with([
            'user' => $user,
            'siswa' => $siswa,
            'siswa_by_id' => $siswaByID, 
            'guru' => $guru,
            'jumlah_siswa' => $jumlahSiswa, 
            'jumlah_user' => $jumlahUser,
            'jumlah_tunggakan' => $jumlahTunggakan,
            'jumlah_tunggakan_siswa' => $jumlahTunggakanSiswa,
        ]);
    }
}

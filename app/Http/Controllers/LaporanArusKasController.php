<?php

namespace App\Http\Controllers;

use App\Models\LaporanTunggakan;
use App\Models\DetailTagihanSPP;
use App\Models\JenisTagihan;
use App\Models\Kelas;
use App\Models\DetailKelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TunggakanExport;

class LaporanArusKasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // dd($request);
        $key = $request->key;
        $q = $request->id_jenis_tagihan;
        $jenis_tagihan = JenisTagihan::get();
        if (Auth::user()->level == 1) {
            if ($request->start_date || $request->end_date) {
                $data = DetailTagihanSPP::whereHas('siswa', function($query) use($key) {
                    $query->where('nama_siswa', 'LIKE', '%'. $key .'%');
                })->get();

                $sum = $data->sum('bayar');
        
            } else {
                $data = DetailTagihanSPP::whereHas('siswa', function($query) use($key) {
                    $query->where('nama_siswa', 'LIKE', '%'. $key .'%');  
                })->whereHas('jenisTagihan', function($query) use($q) {$query->where('id_jenis_tagihan', 'LIKE', '%'. $q .'%');})->get();
                // dd($data);
                $sum = $data->sum('bayar');
          
            }
        }

        if (Auth::user()->level == 2) {
           if ($request->start_date || $request->end_date) {
                $kelas = Kelas::where("id_guru", Auth::user()->id_guru)->get();
                $detailKelas = DetailKelas::where("id_kelas", $kelas[0]->id)->get();
                $subset = $detailKelas->map(function ($detailKelas) {
                    return $detailKelas->id_siswa;
                });
                $data = DetailTagihanSPP::whereIn('id_siswa', $subset)->whereHas('siswa', function($query) use($key) {
                    $query->where('nama_siswa', 'LIKE', '%'. $key .'%');
                    
                })->get();
                $sum = $data->sum('bayar');
            } else {
                $kelas = Kelas::where("id_guru", Auth::user()->id_guru)->get();
                $detailKelas = DetailKelas::where("id_kelas", $kelas[0]->id)->get();
                $subset = $detailKelas->map(function ($detailKelas) {
                    return $detailKelas->id_siswa;
                });
                $data = DetailTagihanSPP::whereIn('id_siswa', $subset)->get();
                $sum = $data->sum('bayar');
            }
        }
        
        return view('pages.laporan_arus_kas.laporan_arus_kas')->with([
            'user' => Auth::user(),
            'data' => $data,
            'key' => $key,
            'jenis_tagihan' => $jenis_tagihan,
            'sum' => $sum
        ]);
    }

    public function exportTunggakan($start_date, $end_date)
    {
        if (Auth::user()->level == 1) {
            if ($start_date || $end_date) {
                $start_date = Carbon::parse($start_date)->toDateTimeString();
                $end_date = Carbon::parse($end_date)->toDateTimeString();
                $data = DetailTagihanSPP::whereBetween('created_at',[$start_date,$end_date])->get();
            } else {
                $data = DetailTagihanSPP::all();
            }
        }

        if (Auth::user()->level == 2) {
            $kelas = Kelas::where("id_guru", Auth::user()->id_guru)->get();
            $detailKelas = DetailKelas::where("id_kelas", $kelas[0]->id)->get();
            $subset = $detailKelas->map(function ($detailKelas) {
                return $detailKelas->id_siswa;
            });

            if ($start_date || $end_date) {
                $start_date = Carbon::parse($start_date)->toDateTimeString();
                $end_date = Carbon::parse($end_date)->toDateTimeString();
                $data = DetailTagihanSPP::whereIn('id_siswa', $subset)->whereBetween('created_at',[$start_date,$end_date])->get();
            } else {
                $data = DetailTagihanSPP::all();
            }
        }
        return Excel::download(new TunggakanExport($data), 'tunggakan.xlsx');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LaporanTunggakan  $laporanTunggakan
     * @return \Illuminate\Http\Response
     */
    public function show(LaporanTunggakan $laporanTunggakan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LaporanTunggakan  $laporanTunggakan
     * @return \Illuminate\Http\Response
     */
    public function edit(LaporanTunggakan $laporanTunggakan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LaporanTunggakan  $laporanTunggakan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LaporanTunggakan $laporanTunggakan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LaporanTunggakan  $laporanTunggakan
     * @return \Illuminate\Http\Response
     */
    public function destroy(LaporanTunggakan $laporanTunggakan)
    {
        //
    }
}

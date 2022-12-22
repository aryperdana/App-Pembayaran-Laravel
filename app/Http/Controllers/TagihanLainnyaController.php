<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\DetailTagihanSPP;
use App\Models\Kelas;
use App\Models\DetailKelas;
use App\Models\Siswa;
use App\Models\TagihanSpp;
use App\Models\JenisTagihan;

class TagihanLainnyaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tagihan = DetailTagihanSPP::where("lainnya", 1)->where('status_pembayaran', 0)->get();
        return view('pages.tagihan_lainnya.tagihan_lainnya')->with([
            'user' => Auth::user(),
            'data' => $tagihan,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jenis_tagihan = JenisTagihan::all();
        $kelas = Kelas::all();
        $siswa = DetailKelas::with('siswa')->get();
        return view('pages.tagihan_lainnya.tambah_tagihan_lainnya')->with([
            'user' => Auth::user(),
            'jenis_tagihan' => $jenis_tagihan,
            'kelas' => $kelas,
            'siswa' => $siswa,
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
        if ($request->ajax()) {
 
            $request->validate([
                'id_kelas' => 'required',
                'bulan' => 'required',
                'semester' => 'required',
                'no_tagihan' => 'required',
            ]);

            $tagihanSpp = new TagihanSpp();
            $tagihanSpp->id_kelas = $request->id_kelas;
            $tagihanSpp->bulan = $request->bulan;
            $tagihanSpp->semester = $request->semester;
            $tagihanSpp->no_tagihan = $request->no_tagihan;
            $tagihanSpp->keterangan = $request->keterangan;
            $tagihanSpp->save();


            foreach ($request->detail_tagihan as $key => $value) {
                $detail_tagihan = array(
                    'id_tagihan_spp'   => $tagihanSpp->id,
                    'id_siswa' => $value['id_siswa'],
                    'id_jenis_tagihan' => $value['id_jenis_tagihan'],
                    'harga' => $value['harga'],
                    'status_pembayaran' => $value['status_pembayaran'],
                    'tunai' => $value['tunai'],
                    'lainnya' => $value['lainnya'],
                );

                $detail_tagihan = DetailTagihanSPP::create($detail_tagihan);
            }            
            
        }

        return 'Data Berhasil Di Tambah';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $jenis_tagihan = JenisTagihan::all();
        $kelas = Kelas::all();
        $siswa = DetailKelas::with('siswa')->get();
        return view('pages.tagihan_lainnya.detail_tagihan_lainnya')->with([
            'user' => Auth::user(),
            'siswa' => $siswa,
            'data' => DetailTagihanSPP::find($id),
            'jenis_tagihan' => $jenis_tagihan,
            'kelas' => $kelas,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
      public function edit($id)
    {
        $jenis_tagihan = JenisTagihan::all();
        $kelas = Kelas::all();
        $siswa = DetailKelas::with('siswa')->get();
        return view('pages.tagihan_lainnya.ubah_tagihan_lainnya')->with([
            'user' => Auth::user(),
            'siswa' => $siswa,
            'data' => DetailTagihanSPP::find($id),
            'jenis_tagihan' => $jenis_tagihan,
            'kelas' => $kelas,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $tagihanSpp)
    {
        if ($request->ajax()) {

            // dd($request);
 
            $request->validate([
                'id_kelas' => 'required',
                'bulan' => 'required',
                'semester' => 'required',
                'no_tagihan' => 'required',
            ]);

            $tagihanSpp = TagihanSpp::find($tagihanSpp);
            $tagihanSpp->id_kelas = $request->id_kelas;
            $tagihanSpp->bulan = $request->bulan;
            $tagihanSpp->semester = $request->semester;
            $tagihanSpp->no_tagihan = $request->no_tagihan;
            $tagihanSpp->keterangan = $request->keterangan;
            $tagihanSpp->save();

            DetailTagihanSPP::whereIn('id_tagihan_spp', $tagihanSpp)->delete();

            foreach ($request->detail_tagihan as $key => $value) {
                $detail_tagihan = array(
                    'id_tagihan_spp'   => $tagihanSpp->id,
                    'id_siswa' => $value['id_siswa'],
                    'id_jenis_tagihan' => $value['id_jenis_tagihan'],
                    'harga' => $value['harga'],
                    'status_pembayaran' => $value['status_pembayaran'],
                    'tunai' => $value['tunai'],
                    'lainnya' => $value['lainnya']
                );

                $detail_tagihan = DetailTagihanSPP::create($detail_tagihan);
            }
            
        }

        return 'Data Berhasil Di Tambah';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($tagihanSpp)
    {
        $tagihanSpp = TagihanSpp::find($tagihanSpp);
        $tagihanSpp->delete();
        DetailTagihanSPP::whereIn('id_tagihan_spp', $tagihanSpp)->delete();
        
        return back()->with('success', 'Data Berhasil Di Hapus');
    }
}

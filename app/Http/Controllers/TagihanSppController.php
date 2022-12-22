<?php

namespace App\Http\Controllers;

use App\Models\DetailKelas;
use App\Models\DetailTagihanSPP;
use App\Models\JenisTagihan;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\TagihanSpp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Twilio\Rest\Client; 

class TagihanSppController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $key = $request->key;
        $tagihan = TagihanSpp::paginate(10);
        return view('pages.tagihan_spp.tagihan_spp')->with([
            'user' => Auth::user(),
            'data' => $tagihan,
        ]);
    }

    public function kelas($id)
    {
        $detail_kelas = DetailKelas::where('id_kelas', $id)->get();
        $id_siswa_arr = array();
        foreach ($detail_kelas as $value) {
            $id_siswa_arr[] = $value['id_siswa'];  
        }

        $getSiswa = Siswa::query()->find($id_siswa_arr);
        
        return response([
            'message' => 'success',
            'data' => $detail_kelas,
            'siswa' => $getSiswa,
        ], 200);
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
        return view('pages.tagihan_spp.tambah_tagihan_spp')->with([
            'user' => Auth::user(),
            'jenis_tagihan' => $jenis_tagihan,
            'kelas' => $kelas,
        ]);
    }

    // public function getKelasById($request)
    // {
    //     return response()->json([
    //         'message' => 'success'
    //     ], 200);
    // }

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
     * @param  \App\Models\TagihanSpp  $tagihanSpp
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $jenis_tagihan = JenisTagihan::all();
        $kelas = Kelas::all();
        $tagihanSpp = TagihanSpp::find($id);
        $detail_kelas = DetailKelas::where('id_kelas', $tagihanSpp->id_kelas)->get();
        $id_siswa_arr = array();
        foreach ($detail_kelas as $value) {
            $id_siswa_arr[] = $value['id_siswa'];  
        }

        $getSiswa = Siswa::query()->find($id_siswa_arr);
        return view('pages.tagihan_spp.detail_tagihan_spp')->with([
            'user' => Auth::user(),
            'siswa' => Siswa::all(),
            'data' => $tagihanSpp,
            'jenis_tagihan' => $jenis_tagihan,
            'kelas' => $kelas,
            'data_siswa' => $getSiswa,
        ]);
    }

    public function sendNotif(Request $request)
    {

        if ($request->ajax()) {
            $sid    = "ACd529b8c3afd7bec46cb62c981a991fd0"; 
            $token  = "18b759884d658a547af312972839cb37"; 
            $twilio = new Client($sid, $token); 


           
            foreach ($request->data_siswa as $key => $value) {
                $message = $twilio->messages 
                    ->create("whatsapp:{$value['no_telp']}", // to 
                            array( 
                                "from" => "whatsapp:+14155238886",       
                                "body" => "Hallo {$value['nama_siswa']}, {$request['message']}" 
                            ) 
                    ); 
            }
            
            
        }

        return 'Data Berhasil Di Tambah';
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TagihanSpp  $tagihanSpp
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $jenis_tagihan = JenisTagihan::all();
        $kelas = Kelas::all();
        return view('pages.tagihan_spp.ubah_tagihan_spp')->with([
            'user' => Auth::user(),
            'siswa' => Siswa::all(),
            'data' => TagihanSpp::find($id),
            'jenis_tagihan' => $jenis_tagihan,
            'kelas' => $kelas,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TagihanSpp  $tagihanSpp
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $tagihanSpp)
    {
        if ($request->ajax()) {
 
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
                );

                $detail_tagihan = DetailTagihanSPP::create($detail_tagihan);
            }
            
        }

        return 'Data Berhasil Di Tambah';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TagihanSpp  $tagihanSpp
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

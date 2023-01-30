<?php

namespace App\Http\Controllers;

use App\Models\DetailKelas;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $key = $request->key;
        $kelas = Kelas
            ::where('kode_kelas', 'LIKE', '%' . $key . '%')
            ->orWhere('tahun_ajaran', 'LIKE', '%' . $key . '%')
            ->orWhere('semester', 'LIKE', '%' . $key . '%')
            ->paginate(10);

        return view('pages.kelas.kelas')->with([
            'user' => Auth::user(),
            'data' => $kelas,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $guru = Guru::all();
        $detail_kelas = DetailKelas::all();
        $subset = $detail_kelas->map(function ($detail_kelas) {
            return $detail_kelas->id_siswa;
        });
        // dd(count($subset));

        $siswa = array();
        if (count($subset) < 0) {
            $siswa = $siswa->where('id', '!=', $subset)->get();
        } else {
            $siswa = Siswa::where('status_siswa', 0)->get();
        }
   
        return view('pages.kelas.tambah_kelas')->with([
            'user' => Auth::user(),
            'guru' => $guru,
            'siswa' => $siswa,
        ]);
    }

    // public function dropdownSiswa()
    // {
    //     $guru = Guru::all();
    //     return response()->json($guru);
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
                'kode_kelas' => 'required',
                'id_guru' => 'required',
                'tahun_ajaran' => 'required',
                'semester' => 'required',
            ]);

            $kelas = new Kelas();
            $kelas->kode_kelas = $request->kode_kelas;
            $kelas->id_guru = $request->id_guru;
            $kelas->tahun_ajaran = $request->tahun_ajaran;
            $kelas->semester = $request->semester;
            $kelas->save();


            foreach ($request->detail_kelas as $key => $value) {
                $detail_kelas = array(
                    'id_kelas'   => $kelas->id,
                    'id_siswa' => $value,
                );

                $detail_kelas = DetailKelas::create($detail_kelas);
            }
        }

        return 'Data Berhasil Di Tambah';
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function show(Kelas $kelas)
    {
        $guru = Guru::all();

        return response()->json($guru);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // dd($id);
        $data = Kelas::find($id);
        $detail_kelas = DetailKelas::where("id_kelas", $id)->get();
        return view('pages.kelas.ubah_kelas')->with([
            'user' => Auth::user(),
            'guru' => Guru::all(),
            'siswa' => Siswa::all(),
            'data' => Kelas::find($id),
            'detail_kelas' => $detail_kelas,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $kelas)
    {
        // dd($request);
        if ($request->ajax()) {
            $request->validate([
                'kode_kelas' => 'required',
                'id_guru' => 'required',
                'tahun_ajaran' => 'required',
                'semester' => 'required',
            ]);

            $kelas = Kelas::find($kelas);
            $kelas->kode_kelas = $request->kode_kelas;
            $kelas->id_guru = $request->id_guru;
            $kelas->tahun_ajaran = $request->tahun_ajaran;
            $kelas->semester = $request->semester;
            $kelas->save();

            DetailKelas::whereIn('id_kelas', $kelas)->delete();

            foreach ($request->detail_kelas as $key => $value) {
                $detail_kelas = array(
                    'id_kelas'   => $kelas->id,
                    'id_siswa' => $value,
                );

                $detail_kelas = DetailKelas::create($detail_kelas);
            }
        }

        return 'Data Berhasil Di Tambah';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function destroy($kelas)
    {
        $kelas = Kelas::find($kelas);
        $kelas->delete();
        DetailKelas::whereIn('id_kelas', $kelas)->delete();
        
        return back()->with('success', 'Data Berhasil Di Hapus');
    }
}

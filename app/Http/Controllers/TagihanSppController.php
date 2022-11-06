<?php

namespace App\Http\Controllers;

use App\Models\TagihanSpp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TagihanSppController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $key = $request->key;
        // $jenis_tagihan = JenisTagihan
        //     ::where('nama_jenis_tagihan', 'LIKE', '%' . $key . '%')
        //     ->orWhere('keterangan', 'LIKE', '%' . $key . '%')
        //     ->paginate(10);
        return view('pages.tagihan_spp.tagihan_spp')->with([
            'user' => Auth::user(),
            // 'data' => $jenis_tagihan,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.tagihan_spp.tambah_tagihan_spp')->with([
            'user' => Auth::user(),
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TagihanSpp  $tagihanSpp
     * @return \Illuminate\Http\Response
     */
    public function show(TagihanSpp $tagihanSpp)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TagihanSpp  $tagihanSpp
     * @return \Illuminate\Http\Response
     */
    public function edit(TagihanSpp $tagihanSpp)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TagihanSpp  $tagihanSpp
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TagihanSpp $tagihanSpp)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TagihanSpp  $tagihanSpp
     * @return \Illuminate\Http\Response
     */
    public function destroy(TagihanSpp $tagihanSpp)
    {
        //
    }
}

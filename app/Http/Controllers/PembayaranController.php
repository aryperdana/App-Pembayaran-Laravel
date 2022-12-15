<?php

namespace App\Http\Controllers;

// use App\Models\DetailTagihanSPP;

use App\Models\DetailTagihanSPP;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id_siswa = Auth::user()->id_siswa;
        $tagihan = array();
        if ($id_siswa != "0") {
            $tagihan = DetailTagihanSPP::where("id_siswa", $id_siswa)->where('status_pembayaran', 0)->get();
        } else {
            $tagihan = DetailTagihanSPP::where('status_pembayaran', 0)->get();
        }
        
        // return $snapToken;


        return view('pages.pembayaran.pembayaran')->with([
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
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $iten_details = $request->detail;
        $item_delete = $request->delete;
        DetailTagihanSPP::whereIn('id_tagihan_spp', $item_delete)->delete();

         foreach ($iten_details as $key => $value) {
            $detail_tagihan = array(
                'id_tagihan_spp'   => $value['id_tagihan_spp'],
                'id_siswa' => $value['id_siswa'],
                'id_jenis_tagihan' => $value['id_jenis_tagihan'],
                'harga' => $value['harga'],
                'status_pembayaran' => $value['status_pembayaran'],
            );

            $detail_tagihan = DetailTagihanSPP::create($detail_tagihan);
        }
        return to_route('pembayaran.index')->with('success', 'Pembayaran Berhasil');

    }

    public function pay(Request $request)
    {
        $iten_details = $request->detail;
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = 'SB-Mid-server-FDoT3_mU35adIXfk6GMEh-39';
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

       //  foreach ($request->detail_tagihan as $key => $value) {
       //     $detail_tagihan = array(
       //         'id_tagihan_spp'   => $tagihanSpp->id,
       //         'id_siswa' => $value['id_siswa'],
       //         'id_jenis_tagihan' => $value['id_jenis_tagihan'],
       //         'harga' => $value['harga'],
       //         'status_pembayaran' => $value['status_pembayaran'],
       //     );

       //     $detail_tagihan = DetailTagihanSPP::create($detail_tagihan);
       // }

        $params = array(
            'transaction_details' => array(
                'order_id' => rand(),
                'gross_amount' => 10000,
            ),
            'customer_details' => array(
                'first_name' => $request->first_name,
                'email' => $request->email,
                'phone' => $request->phone,
            ),
            'item_details' => $iten_details
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);
        return response()->json($snapToken, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pembayaran  $pembayaran
     * @return \Illuminate\Http\Response
     */
    public function show(Pembayaran $pembayaran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pembayaran  $pembayaran
     * @return \Illuminate\Http\Response
     */
    public function edit(Pembayaran $pembayaran)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pembayaran  $pembayaran
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pembayaran $pembayaran)
    {
        

        // DetailTagihanSPP::where('id_tagihan_spp', $id)->delete();
        
        // foreach ($request->detail_tagihan as $key => $value) {
        //     $detail_tagihan = array(
        //         'id_tagihan_spp'   => $value['id_tagihan_spp'],
        //         'id_siswa' => $value['id_siswa'],
        //         'id_jenis_tagihan' => $value['id_jenis_tagihan'],
        //         'harga' => $value['harga'],
        //         'status_pembayaran' => $value['status_pembayaran'],
        //     );

        //     $detail_tagihan = DetailTagihanSPP::create($detail_tagihan);
        // }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pembayaran  $pembayaran
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pembayaran $pembayaran)
    {
        //
    }
}

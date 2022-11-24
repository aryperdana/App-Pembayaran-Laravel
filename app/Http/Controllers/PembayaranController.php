<?php

namespace App\Http\Controllers;

// use App\Models\DetailTagihanSPP;

use App\Models\DetailTagihanSPP;
use App\Models\Pembayaran;
use App\Models\TagihanSpp;
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
        $tagihan = DetailTagihanSPP::where("id_siswa", $id_siswa)->get();

       


        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = 'SB-Mid-server-FDoT3_mU35adIXfk6GMEh-39';
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => rand(),
                'gross_amount' => 10000,
            ),
            'customer_details' => array(
                'first_name' => 'budi',
                'last_name' => 'pratama',
                'email' => 'budi.pra@example.com',
                'phone' => '08111222333',
            ),
            'item_details' => array(
                [
                    'id'=> 'a01',
                    'price'=> 7000,
                    'quantity'=> 1,
                    'name'=> 'Apple'
                ],
                [
                    'id'=> 'b02',
                    'price'=> 3000,
                    'quantity'=> 2,
                    'name'=> 'Orange'
                ] 
                ),
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);

        // return $snapToken;


        return view('pages.pembayaran.pembayaran')->with([
            'user' => Auth::user(),
            'data' => $tagihan,
            'snap_token' => $snapToken,
        ]);
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
        //
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
        //
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

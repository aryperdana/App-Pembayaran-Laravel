<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LayoutController extends Controller
{
    public function index()
    {
        return view('layout.home')->with([
            'user' => Auth::user(),
        ]);
    }
}

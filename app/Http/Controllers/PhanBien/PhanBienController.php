<?php

namespace App\Http\Controllers\PhanBien;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PhanBienController extends Controller
{
    //
    public function show()
    {
        return view('Home.Phanbien');
    }
}

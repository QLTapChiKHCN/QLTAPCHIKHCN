<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TrangChuController extends Controller
{
    public function index()
    {
        return view('Home.TrangChu');
    }
}

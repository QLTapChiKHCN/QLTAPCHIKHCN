<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostArticleController extends Controller
{
    //
    public function showpost()
    {
        return view('Home.Post');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        return view('pages.home'); //gọi file home.blade.php từ folder pages
    }
}

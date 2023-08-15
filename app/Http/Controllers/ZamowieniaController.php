<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ZamowieniaController extends Controller
{
    public function index(){
        return view('zamowienia.index');
    }
}

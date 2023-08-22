<?php

namespace App\Http\Controllers\Kelner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KelnerController extends Controller
{
    public function index(){


        return view('kelner.index');
    }
}

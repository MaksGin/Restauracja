<?php

namespace App\Http\Controllers\Kuchnia;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KuchniaController extends Controller
{
    public function index(){

        return view('kuchnia.index');
    }
}

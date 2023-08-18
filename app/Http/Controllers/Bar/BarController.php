<?php

namespace App\Http\Controllers\Bar;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BarController extends Controller
{
    public function index(){

        return view('bar.index');
    }
}

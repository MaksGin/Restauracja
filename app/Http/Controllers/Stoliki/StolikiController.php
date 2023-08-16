<?php

namespace App\Http\Controllers\Stoliki;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Stolik;
class StolikiController extends Controller
{
    public function index(){

        $stoliki = Stolik::all();

        return view('stoliki.index',compact('stoliki'));

    }
}

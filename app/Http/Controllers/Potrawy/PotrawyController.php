<?php

namespace App\Http\Controllers\Potrawy;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Potrawa;
use App\Models\kategoriePotraw;
class PotrawyController extends Controller
{
    public function index(){

        $potrawy = Potrawa::all();
        $kategorie = kategoriePotraw::has('potrawy')->get();
        return view('potrawy.index',compact('potrawy','kategorie'));

    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stolik;
use App\Models\kategoriePotraw;
use App\Models\Potrawa;
class ZamowieniaController extends Controller
{
    public function index(){
        return view('zamowienia.index');
    }

    public function addZamowieniePanel(){

        $id_stolikow = Stolik::all('id');
        $kategorie = kategoriePotraw::all();
        $potrawy = Potrawa::all();
        return view('zamowienia.add',compact('id_stolikow','kategorie'));
    }



}

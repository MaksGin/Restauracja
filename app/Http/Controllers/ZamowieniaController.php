<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stolik;
use App\Models\kategoriePotraw;
use App\Models\Potrawa;
use App\Models\Zamowienia;
class ZamowieniaController extends Controller
{
    public function index(){

        $stoliki = Stolik::all();
        $potrawy = Potrawa::all();
        $zamowienia = Zamowienia::all();

        return view('zamowienia.index',compact('stoliki','potrawy','zamowienia'));
    }

    public function addZamowieniePanel(){

        $id_stolikow = Stolik::all('id');
        $kategorie = kategoriePotraw::all();
        $potrawy = Potrawa::all();
        return view('zamowienia.add',compact('id_stolikow','kategorie','potrawy'));
    }

    public function PotrawyAll(){
        $id_stolikow = Stolik::all('id');
        $kategorie = kategoriePotraw::all();
        $potrawy = Potrawa::all();
        $toJson = $potrawy->toJson();
        return response()->json($toJson);

    }

    public function getPotrawy(){

        $wszystkie_potrawy = Potrawa::all();

        $jsonData = $wszystkie_potrawy->toJson();

        return response()->json($jsonData);
    }


    public function getPotrawyByCategory($id_kategorii){

        $napoje = Potrawa::where('id_kategorii',$id_kategorii)->get();

        $jsonData = $napoje->toJson();

        return response()->json($jsonData);
    }

    public function getStoliki(){
        $stoliki = Stolik::all();

        $jsonData = $stoliki->toJson();

        return response()->json($jsonData);
    }
}

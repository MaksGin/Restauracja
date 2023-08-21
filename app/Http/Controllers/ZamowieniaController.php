<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stolik;
use App\Models\kategoriePotraw;
use App\Models\Potrawa;
use App\Models\Zamowienia;
use App\Models\Kuchnia;
use App\Models\ZamowieniaPotrawy;
use Illuminate\Support\Facades\Auth;

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

    public function SaveZamowienie(Request $request)
    {

        $idKelnera = $request->input('id_kelnera');
        $cenaPotrawy = $request->input('cena_potrawy');
        $idStolika = $request->input('id_stolika');
        $zaznaczonePotrawy = explode(',', $request->input('zaznaczone_potrawy'));


        $zamowienie = new Zamowienia();
        $zamowienie->id_kelnera = $idKelnera;
        $zamowienie->id_stoliku = $idStolika;
        $zamowienie->cena = $cenaPotrawy;
        $zamowienie->save();

        // Zapisanie zaznaczonych potraw w relacji
        foreach ($zaznaczonePotrawy as $potrawaId) {
            // Rekord do tabeli potrawy_zamowienia
            $zamowienie->potrawy()->attach($potrawaId);
        }
        $IDzamowienia = $zamowienie->id;


        $zamowienie->kuchnie()->attach($IDzamowienia);


        //$zamowienie->kuchnia()->associate($IDzamowienia);


        $stoliki = Stolik::all();
        $potrawy = Potrawa::all();
        $zamowienia = Zamowienia::all();

        return view('zamowienia.index',compact('stoliki','potrawy','zamowienia'));
    }

    public function details($id){

        $zamowienie = Zamowienia::findOrFail($id);

        $potrawy_zamowienia = ZamowieniaPotrawy::where("zamowienie_id",$zamowienie->id)->get(); //pobieram potrawy z tabeli potrawy_zamowienia odpowiadajace id zamowienia


        return view('zamowienia.details',compact('zamowienie','potrawy_zamowienia'));
    }

}

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
use Carbon\Carbon;
use Illuminate\Support\Facades\App;

class ZamowieniaController extends Controller
{
    public function index(){

        $teraz = Carbon::now();
        $Data = $teraz->format('Y-m-d');

        $stoliki = Stolik::all();
        $potrawy = Potrawa::all();
        $zamowienia = Zamowienia::whereDate('Data','=',$Data)->get();

        return view('zamowienia.index',compact('stoliki','potrawy','zamowienia','Data'));
    }

    public function addZamowieniePanel(){

        $id_stolikow = Stolik::all('id');
        $kategorie = kategoriePotraw::all();
        $potrawy = Potrawa::all();
        $stoliki = Stolik::all();
        $translatedStoliki = [];

        foreach ($stoliki as $stolik) {
            $translatedStoliki[$stolik->nazwa] = __('public.' . $stolik->nazwa);
        }
        return view('zamowienia.add',compact('id_stolikow','kategorie','potrawy','stoliki','translatedStoliki'));
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

        //pobieram potrawy z konkretnej kategorii i wysyłam je formatem json
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

        $teraz = Carbon::now();
        $Data = $teraz->format('Y-m-d');

        $idKelnera = $request->input('id_kelnera');
        $cenaPotrawy = $request->input('cena_potrawy');
        $idStolika = $request->input('id_stolika');
        $id_statusu_kuchnia = $request->input('id_statusu_kuchnia');
        $zaznaczonePotrawy = explode(',', $request->input('zaznaczone_potrawy'));

        //data zamowienia
        $aktualna_data = Carbon::now();
        $Data = $teraz->format('Y-m-d');


        $zamowienie = new Zamowienia();
        $zamowienie->data = $Data;
        $zamowienie->id_kelnera = $idKelnera;
        $zamowienie->id_stoliku = $idStolika;
        $zamowienie->id_statusu_kuchnia = $id_statusu_kuchnia;
        $zamowienie->cena = $cenaPotrawy;
        $zamowienie->save();

        // Zapisuje zaznaczone potrawy do tabeli zamowienia_potrawy
        foreach ($zaznaczonePotrawy as $potrawaId) {
            $zamowienie->potrawy()->attach($potrawaId);
        }

        $IDzamowienia = $zamowienie->id;

        $zamowienie->kuchnie()->attach($IDzamowienia);

        //jestli zamowienia zawiera potrawe o kategorii 6 czyli deser to zapisz rekord w tabeli bar_zamowienia
        if($zamowienie->potrawy()->where('id_kategorii','=',6)){
            $zamowienie->bar()->attach($IDzamowienia);
        }

        //$zamowienie->kuchnia()->associate($IDzamowienia);

        //zmienne potrzebne do widoku po dodaniu zamowienia
        $stoliki = Stolik::all();
        $potrawy = Potrawa::all();
        $zamowienia = Zamowienia::whereDate('Data','=',$Data)->get();

        return view('zamowienia.index',compact('stoliki','potrawy','zamowienia','Data'));
    }

    public function details($id){

        $zamowienie = Zamowienia::findOrFail($id);

        $potrawy_zamowienia = ZamowieniaPotrawy::where("zamowienie_id",$zamowienie->id)->get(); //pobieram potrawy z tabeli potrawy_zamowienia odpowiadajace id zamowienia

        return view('zamowienia.details',compact('zamowienie','potrawy_zamowienia'));
    }

}

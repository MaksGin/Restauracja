<?php

namespace App\Http\Controllers\Kelner;

use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;

use Illuminate\Http\Request;
use App\Models\Zamowienia;
use App\Models\ZamowieniaPotrawy;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\Stolik;
use App\Models\Potrawa;

class KelnerController extends Controller
{
    public function index(){

        $stoliki = Stolik::all();
        $potrawy = Potrawa::all();

        $translatedStoliki = [];
        $translatedPotrawy = [];

        foreach ($stoliki as $stolik) {
            $translatedStoliki[$stolik->nazwa] = __('public.' . $stolik->nazwa);
            $translatedStoliki[$stolik->umiejscowienie] = __('public.' . $stolik->umiejscowienie);
        }
        foreach ($potrawy as $potrawa) {
            $translatedPotrawy[$potrawa->nazwa] = __('public.' . $potrawa->nazwa);
        }
        return view('kelner.index',compact('translatedStoliki','translatedPotrawy'));
    }


    public function raporty(){

        //data zamowienia
        $aktualna_data = Carbon::now();
        $dzisiejsza_data = $aktualna_data->format('Y-m-d');
        $poland_time = $aktualna_data->setTimezone('EET'); //timezone na wschodnia europe

        $zamowienia = Zamowienia::whereDate('Data', '=', $dzisiejsza_data)
        ->where('id_statusu_kuchnia', '=', 6)
        ->get();


        $podsumowanie = 0;

        foreach ($zamowienia as $zamowienie) {
            $zamowienie_potrawy = ZamowieniaPotrawy::where("zamowienie_id", $zamowienie->id)->get();

            // Zaktualizuj podsumowanie o cenę zamówienia
            $podsumowanie += $zamowienie->cena;


                // Przekazanie listy potraw do tablicy w zamówieniu
                $zamowienie->potrawy->nazwa = $zamowienie_potrawy;



        }
        $brak_zamowien = $zamowienia->isEmpty();


        return view('kelner.raport',compact('dzisiejsza_data','zamowienia','podsumowanie','brak_zamowien'));

    }

    public function exportPDF(){


        $aktualna_data = Carbon::now();
        $dzisiejsza_data = $aktualna_data->format('Y-m-d');
        $poland_time = $aktualna_data->setTimezone('EET');

        $zamowienia = Zamowienia::whereDate('Data', '=', $dzisiejsza_data)->get();
        $podsumowanie = 0;

        //zliczanie ceny wszystkich zamowien w dniu
        foreach($zamowienia as $zamowienie){

            $podsumowanie += $zamowienie->cena;
        }

        $tableData = [
            'dzisiejsza_data'=>$dzisiejsza_data,
            'zamowienia' => $zamowienia,
            'podsumowanie' => $podsumowanie,


        ];



        $pdf = PDF::loadView('kelner.pdf', $tableData);

        // Pobierz PDF
        return $pdf->download("zamowienia z dnia $dzisiejsza_data.pdf");
    }

    public function getReadyPotrawy(){


        $gotowe_zamowienia = Zamowienia::where('id_statusu_kuchnia','3')->get();
        $gotowe_zamowienia_ID = $gotowe_zamowienia->pluck('id');

        $Lista_gotowych = ZamowieniaPotrawy::whereIn('zamowienie_id', $gotowe_zamowienia_ID)
        ->with('potrawy') //ładuje relacje potrawy
        ->get();


        //tablica tych samych właściwosci co w zapytaniu gotowe_zamowienia ale z uwzględnieniem nazwy potrawy w relacji
        $transformedData = $gotowe_zamowienia->map(function ($item) {
            return [
                'id' => $item->id,
                'id_kelnera' => $item->id_kelnera,
                'id_stoliku' => $item->id_stoliku,
                'id_statusu_kuchnia' => $item->id_statusu_kuchnia,
                'nazwa' => $item->stolik->nazwa,
                'umiejscowienie' => $item->stolik->umiejscowienie,
                'cena' => $item->cena,
                'potrawy' => $item->potrawy->pluck('nazwa')->toArray()
            ];
        });
        $jsonData = $transformedData->toJson();

        return response()->json($jsonData);
    }

    public function updateOrderStatus(Request $request)
    {
        $orderId = $request->input('orderId');

        $order = Zamowienia::find($orderId);
        if ($order) {

            $order->id_statusu_kuchnia = 6; // Nowa wartość
            $order->save();

            return view('bar.index');
        } else {

        }
    }



}

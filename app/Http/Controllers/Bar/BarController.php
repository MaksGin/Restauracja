<?php

namespace App\Http\Controllers\Bar;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Zamowienia;
use App\Models\ZamowieniaPotrawy;
use App\Models\Kuchnia;
use App\Models\Bar;
use App\Models\Stolik;
use App\Models\Potrawa;

class BarController extends Controller
{
    public function index(){

        //dane potrzebne do tłumaczen stolikow i potraw w sektorach oczekujace i w trakcie
        $potrawy = Potrawa::all();
        $stoliki = Stolik::all();
        $translatedStoliki = [];

        foreach ($stoliki as $stolik) {
            $translatedStoliki[$stolik->nazwa] = __('public.' . $stolik->nazwa);
            $translatedStoliki[$stolik->umiejscowienie] = __('public.' . $stolik->umiejscowienie);
        }
        foreach ($potrawy as $potrawa) {
            $translatedPotrawy[$potrawa->nazwa] = __('public.' . $potrawa->nazwa);
        }
        return view('bar.index',compact('translatedStoliki','translatedPotrawy'));
    }

    public function getWaitingNapoje(): \Illuminate\Http\JsonResponse
    {

        /*
        $bar_zamowienia = Bar::with(['zamowienia' => function ($query) {
            $query->where('id_statusu_kuchnia', '5');
        }])->get();
        */
        $waiting_zamowienia = Zamowienia::where('id_statusu_bar', 3)
        ->orWhere('id_statusu_bar', 5)
        ->orWhere('id_statusu_bar',1)
        ->get();

        $waiting_zamowienia_ID = $waiting_zamowienia->pluck('id');

        $Lista_oczekujacych = ZamowieniaPotrawy::whereIn('zamowienie_id', $waiting_zamowienia_ID)
            ->with('potrawy')
            ->get();


        $transformedData = $waiting_zamowienia->map(function ($item) {


            //filtruje potrawy po kategoriach i wyswietlam tylko desery i napoje
            $filteredPotrawy = $item->potrawy->filter(function ($potrawa) {
                return in_array($potrawa->kategoria->id, [12, 14]); //dla bazy na praktykach 4 i 6 a w domu 12 i 14
            });

            return [
                'id' => $item->id,
                'id_kelnera' => $item->id_kelnera,
                'id_stoliku' => $item->id_stoliku,
                'nazwa' => $item->stolik->nazwa,
                'umiejscowienie' => $item->stolik->umiejscowienie,
                'id_statusu_kuchnia' => $item->id_statusu_kuchnia,
                'id_statusu_bar' => $item->id_statusu_bar,
                'cena' => $item->cena,
                'potrawy' => $filteredPotrawy->pluck('nazwa')->toArray()
            ];
        });



        $jsonData = $transformedData->toJson();

        return response()->json($jsonData);
    }

    public function updateOrderBar(Request $request)
    {
        $orderId = $request->input('orderId');

        $order = Zamowienia::find($orderId);
        if ($order) {

            $order->id_statusu_bar = 6; // Nowa wartość
            $order->save();

            return view('bar.index');
        } else {

        }
    }


}

<?php

namespace App\Http\Controllers\Kuchnia;
use App\Models\Kuchnia;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Zamowienia;
use App\Models\ZamowieniaPotrawy;
use App\Models\Potrawa;
use App\Models\Stolik;

class KuchniaController extends Controller
{
    public function index(){


        $kuchnie = Kuchnia::all();
        $zamowienia = collect();

        foreach ($kuchnie as $kuchnia) {
            $zamowieniaKuchni = $kuchnia->zamowienia; // Pobierz zamówienia przypisane do danej kuchni
            $zamowienia = $zamowienia->merge($zamowieniaKuchni);
        }

        $oczekujace = $zamowienia->where("id_statusu_kuchnia", '=', 5);
        $wTrakcie = $zamowienia->where("id_statusu_kuchnia", '=', 1);


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

        $jsonData = $zamowienia->toJson();

        return view('kuchnia.index',compact('kuchnie','zamowienia','jsonData','oczekujace','wTrakcie','translatedStoliki','translatedPotrawy'));
    }

    public function ChangeStatus(Request $request)
    {
        try {
            $orderId = $request->input('orderId');
            $newStatus = 1;

            //znajdz zamowienie z pobranego id
            $order = Zamowienia::find($orderId);

            if (!$order) {
                return redirect()->back()->withErrors(['error' => 'An error occurred']);
            }

            // update statusu do 1 czyli 'w trakcie'
            $order->id_statusu_kuchnia = $newStatus;
            $order->save();

            // pobierz dane do zwrócenia widoku
            $kuchnie = Kuchnia::all();
            $zamowienia = collect();

            foreach ($kuchnie as $kuchnia) {
                $zamowieniaKuchni = $kuchnia->zamowienia; // Pobierz zamówienia przypisane do danej kuchni
                $zamowienia = $zamowienia->merge($zamowieniaKuchni);
            }

            $oczekujace = $zamowienia->where("id_statusu_kuchnia", '=', 5);
            $wTrakcie = $zamowienia->where("id_statusu_kuchnia", '=', 1);
            $jsonData = $zamowienia->toJson();


            return view('kuchnia.index',compact('kuchnie','zamowienia','oczekujace','wTrakcie'));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'An error occurred']);
        }
    }

    public function readyKuchnia(Request $request){

        $orderId = $request->input('orderId');
        $newStatus = 3;

        //znajdz zamowienie z pobranego id
        $order = Zamowienia::find($orderId);

        // update statusu do 3 czyli 'gotowe do odbioru'
        $order->id_statusu_kuchnia = $newStatus;
        $order->save();

        // pobierz dane do zwrócenia widoku
        $kuchnie = Kuchnia::all();
        $zamowienia = collect();

        foreach ($kuchnie as $kuchnia) {
            $zamowieniaKuchni = $kuchnia->zamowienia; // Pobierz zamówienia przypisane do danej kuchni
            $zamowienia = $zamowienia->merge($zamowieniaKuchni);
        }

        $oczekujace = $zamowienia->where("id_statusu_kuchnia", '=', 5);
        $wTrakcie = $zamowienia->where("id_statusu_kuchnia", '=', 1);
        $jsonData = $zamowienia->toJson();


        return view('kuchnia.index',compact('kuchnie','zamowienia','oczekujace','wTrakcie'));

    }

    public function CancelKuchnia(Request $request){

        /*
        $orderId = $request->input('orderId');
        $order = Zamowienia::find($orderId);
        $bar_zamowienie = Bar::where('id_zamowienia','=',$orderId);
        $zamowienie_w_kuchni = Kuchnia::where('id_zamowienia','=',$orderId);
        $potrawy_zamowienia = ZamowieniaPotrawy::where('zamowienie_id','=',$orderId);
        $potrawy_zamowienia->delete();
        $zamowienie_w_kuchni->delete();
        $bar_zamowienie->delete();
        $order->delete();
        */
        $orderId = $request->input('orderId');
        $newStatus = 2;

        //znajdz zamowienie z pobranego id
        $order = Zamowienia::find($orderId);

        // update statusu do 3 czyli 'gotowe do odbioru'
        $order->id_statusu_kuchnia = $newStatus;
        $order->save();

        // pobierz dane do zwrócenia widoku
        $kuchnie = Kuchnia::all();
        $zamowienia = collect();

        foreach ($kuchnie as $kuchnia) {
            $zamowieniaKuchni = $kuchnia->zamowienia; // Pobierz zamówienia przypisane do danej kuchni
            $zamowienia = $zamowienia->merge($zamowieniaKuchni);
        }

        $oczekujace = $zamowienia->where("id_statusu_kuchnia", '=', 5);
        $wTrakcie = $zamowienia->where("id_statusu_kuchnia", '=', 1);
        $jsonData = $zamowienia->toJson();


        return view('kuchnia.index',compact('kuchnie','zamowienia','oczekujace','wTrakcie'));
    }

    public function getWaitingPotrawy(){

        $waiting_zamowienia = Zamowienia::where('id_statusu_kuchnia','5')->get();
        $waiting_zamowienia_ID = $waiting_zamowienia->pluck('id');

        $Lista_oczekujacych = ZamowieniaPotrawy::whereIn('zamowienie_id', $waiting_zamowienia_ID)
            ->with('potrawy')
            ->get();


        $transformedData = $waiting_zamowienia->map(function ($item) {
            $excludedIds = [12, 14];

            $filteredPotrawy = $item->potrawy->filter(function ($potrawa) use ($excludedIds) {
                return !in_array($potrawa->kategoria->id, $excludedIds);
            });

            return [
                'id' => $item->id,
                'id_kelnera' => $item->id_kelnera,
                'id_stoliku' => $item->id_stoliku,
                'id_statusu_kuchnia' => $item->id_statusu_kuchnia,
                'nazwa' => $item->stolik->nazwa,
                'umiejscowienie' => $item->stolik->umiejscowienie,
                'cena' => $item->cena,
                'potrawy' => $filteredPotrawy->pluck('nazwa')->toArray()
            ];
        });

        $jsonData = $transformedData->toJson();

        return response()->json($jsonData);
    }


    public function getPotrawyWtrakcie(){

        $zamowienia_wTrakcie = Zamowienia::where('id_statusu_kuchnia','1')->get();
        $zamowienia_wTrakcie_ID = $zamowienia_wTrakcie->pluck('id');

        $Lista_wTrakcie = ZamowieniaPotrawy::whereIn('zamowienie_id', $zamowienia_wTrakcie_ID)
        ->with('potrawy') //ładuje relacje potrawy
        ->get();



        $transformedData = $zamowienia_wTrakcie->map(function ($item) {

            $excludedIds = [12, 14];

            $filteredPotrawy = $item->potrawy->filter(function ($potrawa) use ($excludedIds) {
                return !in_array($potrawa->kategoria->id, $excludedIds);
            });


            return [
                'id' => $item->id,
                'id_kelnera' => $item->id_kelnera,
                'id_stoliku' => $item->id_stoliku,
                'id_statusu_kuchnia' => $item->id_statusu_kuchnia,
                'nazwa' => $item->stolik->nazwa,
                'umiejscowienie' => $item->stolik->umiejscowienie,
                'cena' => $item->cena,
                'potrawy' => $filteredPotrawy->pluck('nazwa')->toArray()
            ];
        });
        $jsonData = $transformedData->toJson();

        return response()->json($jsonData);

    }

}

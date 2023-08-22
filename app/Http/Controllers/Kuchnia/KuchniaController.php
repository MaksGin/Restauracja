<?php

namespace App\Http\Controllers\Kuchnia;
use App\Models\Kuchnia;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Zamowienia;
use App\Models\ZamowieniaPotrawy;

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

        $jsonData = $zamowienia->toJson();




        return view('kuchnia.index',compact('kuchnie','zamowienia','jsonData','oczekujace','wTrakcie'));
    }

    public function modifyKuchnia(Request $request)
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

        // update statusu do 1 czyli 'gotowe do odbioru'
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
        $orderId = $request->input('orderId');
        $order = Zamowienia::find($orderId);
        $zamowienie_w_kuchni = Kuchnia::where('id_zamowienia','=',$orderId);
        $potrawy_zamowienia = ZamowieniaPotrawy::where('zamowienie_id','=',$orderId);
        $potrawy_zamowienia->delete();
        $zamowienie_w_kuchni->delete();
        $order->delete();


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


        $oczekujace_zamowienia = Zamowienia::where('id_statusu_kuchnia','3')->get();
        $jsonData = $oczekujace_zamowienia->toJson();

        return response()->json($jsonData);
    }

}

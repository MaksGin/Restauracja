<?php

namespace App\Http\Controllers\Kelner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Zamowienia;
use App\Models\ZamowieniaPotrawy;

class KelnerController extends Controller
{
    public function index(){


        return view('kelner.index');
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

            return view('kelner.index');
        } else {

        }
    }



}

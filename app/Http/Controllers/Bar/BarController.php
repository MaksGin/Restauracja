<?php

namespace App\Http\Controllers\Bar;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Zamowienia;
use App\Models\ZamowieniaPotrawy;
use App\Models\Kuchnia;
use App\Models\Bar;

class BarController extends Controller
{
    public function index(){

        return view('bar.index');
    }

    public function getWaitingPotrawy(){

        /*
        $bar_zamowienia = Bar::with(['zamowienia' => function ($query) {
            $query->where('id_statusu_kuchnia', '5');
        }])->get();
        */


        $waiting_zamowienia = Zamowienia::where('id_statusu_kuchnia', 3)
        ->orWhere('id_statusu_kuchnia', 5)
        ->get();

        $waiting_zamowienia_ID = $waiting_zamowienia->pluck('id');

        $Lista_oczekujacych = ZamowieniaPotrawy::whereIn('zamowienie_id', $waiting_zamowienia_ID)
            ->with('potrawy')
            ->get();


        $transformedData = $waiting_zamowienia->map(function ($item) {


            //filtruje potrawy po kategoriach i wyswietlam tylko desery i napoje
            $filteredPotrawy = $item->potrawy->filter(function ($potrawa) {
                return in_array($potrawa->kategoria->id, [4, 6]);
            });

            return [
                'id' => $item->id,
                'id_kelnera' => $item->id_kelnera,
                'id_stoliku' => $item->id_stoliku,
                'id_statusu_kuchnia' => $item->id_statusu_kuchnia,
                'cena' => $item->cena,
                'potrawy' => $filteredPotrawy->pluck('nazwa')->toArray()
            ];
        });



        $jsonData = $transformedData->toJson();

        return response()->json($jsonData);
    }



}

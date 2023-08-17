<?php

namespace App\Http\Controllers\Rezerwacje;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rezerwacje;
use App\Models\Stolik;
use Carbon\Carbon;
class RezerwacjaController extends Controller
{
    public function index(){

        $stoliki = Stolik::all();
        return view('rezerwacje.index',compact('stoliki'));
    }

    public function wybor(Request $request)
    {
        //stoliki dla widoku po zatwierdzeniu formularza
        $stoliki = Stolik::all();

        $idStolu = $request->input('id_stolu');
        $nazwisko = $request->input('nazwisko');

        $data = $request->input('od');
        $czas = $request->input('czas');


        // Sprawdź, czy istnieje już rezerwacja dla danego stolika i czasu
        $rezerwacjaIstnieje = Rezerwacje::where('id_stoly', $idStolu)
        ->where('od', '<=', date('Y-m-d H:i:s', strtotime($data) + $czas))
        ->where('do', '>=', $data)
        ->exists();

        if ($rezerwacjaIstnieje) {
            $wiadomosc1 = 'Nie można zarezerwować tego stolika w tym czasie.';
            return view('rezerwacje.index', compact('wiadomosc1','stoliki'));
        }

        $rezerwacja = new Rezerwacje();
        $rezerwacja->od = $data;
        $rezerwacja->do = date('Y-m-d H:i:s', strtotime($data) + $czas);
        $rezerwacja->id_stoly = $idStolu;
        $rezerwacja->nazwisko = $nazwisko;
        $rezerwacja->save();

        $id_stolu = Stolik::all();


        $wiadomosc = 'Poprawnie dodano rezerwację!';

        // Przekieruj na drugi formularz, przekazując ID zapisanej rezerwacji
        return view('rezerwacje.index',compact('wiadomosc','stoliki'));
    }


    public function lista(){

        $lista_rezerwacji = Rezerwacje::all();

        $currentDate = Carbon::now()->format('Y-m-d');
        $rezerwacja = Rezerwacje::whereDate('od', $currentDate)->get();

        return response()->json($rezerwacja);
    }
}

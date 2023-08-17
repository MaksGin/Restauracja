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
        $jsonData = $rezerwacja->toJson();
        return view('rezerwacje.lista', ['jsonData' => $jsonData],compact('lista_rezerwacji'));

    }

    public function getRezerwacjeToday()
    {
        $currentDate = Carbon::now()->format('Y-m-d');
        $reservations = Rezerwacje::whereDate('od', $currentDate)->get(); // Pobierz rezerwacje z bazy danych
        return response()->json($reservations);
    }

    public function Rezerwacje7days(){

        $currentDate = Carbon::now()->format('Y-m-d');
        $futureDate = Carbon::now()->addDays(7)->format('Y-m-d');
        $futureRezerwacje = Rezerwacje::whereDate('od','>',$currentDate)
            ->whereDate('od','<=',$futureDate)->get();

        $jsonDataNext7days = $futureRezerwacje->toJson();

        return response()->json($jsonDataNext7days);
    }

    public function RezerwacjeDoTylu7Dni(){

        $currentDate = Carbon::now()->format('Y-m-d');
        $pastDate = Carbon::now()->subDays(7)->format('Y-m-d');
        $pastRezerwacje = Rezerwacje::whereDate('od','<',$currentDate)
            ->whereDate('od','>=',$pastDate)->get();

        $toJson = $pastRezerwacje->toJson();

        return response()->json($toJson);

    }



}

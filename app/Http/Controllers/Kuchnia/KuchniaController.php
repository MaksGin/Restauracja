<?php

namespace App\Http\Controllers\Kuchnia;
use App\Models\Kuchnia;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Zamowienia;
class KuchniaController extends Controller
{
    public function index(){


        $kuchnie = Kuchnia::all();
        $zamowienia = collect();

        foreach ($kuchnie as $kuchnia) {
            $zamowieniaKuchni = $kuchnia->zamowienia; // Pobierz zamówienia przypisane do danej kuchni
            $zamowienia = $zamowienia->merge($zamowieniaKuchni);
        }



        return view('kuchnia.index',compact('kuchnie','zamowienia'));
    }
}

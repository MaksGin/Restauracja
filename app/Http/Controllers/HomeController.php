<?php

namespace App\Http\Controllers;

use App\Models\kategoriePotraw;
use App\Models\Potrawa;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $potrawy = Potrawa::all();

        //pobierz kategorie które maja przypisane dania
        $kategorie = kategoriePotraw::has('potrawy')->get();
        return view('welcome', compact('potrawy','kategorie'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\kategoriePotraw;
use App\Models\Potrawa;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        $potrawy = Potrawa::with('kategoria')->get();
        $kategorie = kategoriePotraw::all();

        return view('main.index', compact('potrawy', 'kategorie'));
    }
}

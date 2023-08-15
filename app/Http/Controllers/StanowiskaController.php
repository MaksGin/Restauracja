<?php

namespace App\Http\Controllers;

use App\Models\Stanowisko;
use Illuminate\Http\Request;

class StanowiskaController extends Controller
{
    public function index(){
        $stanowiska = Stanowisko::all();

        return view('pracownicy.stanowiska',compact('stanowiska'));
    }
}

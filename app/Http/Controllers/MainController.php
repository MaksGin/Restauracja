<?php

namespace App\Http\Controllers;

use App\Models\Potrawa;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index(){

        $potrawy = Potrawa::all();
        return view('main.index', compact('potrawy'));
    }
}

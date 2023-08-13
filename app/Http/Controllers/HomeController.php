<?php

namespace App\Http\Controllers;

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

        return view('welcome', compact('potrawy'));
    }
}

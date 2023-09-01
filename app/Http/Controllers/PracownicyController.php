<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PracownicyController extends Controller
{
    public function index(){
        $pracownicy = User::all();

        return view('pracownicy.index',compact('pracownicy'));
    }

    public function edit($id){
        $pracownik = User::find($id);


        return view('pracownicy.edit',compact('pracownik'));
    }

    public function create(){

        return view('auth.register');

    }

    public function update(Request $request, $id): \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
    {
        $user = User::find($id);

        $validatedData = $request->validate([
            'imie' => 'required',
            'email' => 'required',
            'telefon' => 'required',

        ]);

        $user->name = $validatedData['imie'];
        $user->email = $validatedData['email'];
        $user->telefon = $validatedData['telefon'];
        $user->save();
        $pracownicy = User::all();
        return view('pracownicy.index',compact('pracownicy'));
    }

    public function destroy($id){
        $pracownik = User::find($id);

        $pracownik->delete();

        $pracownicy = User::all();
        return view('pracownicy.index',compact('pracownicy'));
    }
}

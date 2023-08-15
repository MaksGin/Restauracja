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

    public function update(Request $request, User $user): \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
    {
        $validatedData = $request->validate([
            'imie' => 'required',
            'email' => 'required',
            'telefon' => 'required',

        ]);

        $user->update($validatedData);
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

<?php

namespace App\Http\Controllers\Kategorie;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\kategoriePotraw;
use App\Models\MiejsceRealizacji;
class KategorieController extends Controller
{
    public function index(){

        $lista_kategorii = kategoriePotraw::all();
        $miejsce = MiejsceRealizacji::all();
        return view('kategorie.index',compact('lista_kategorii','miejsce'));
    }

    public function store(Request $request){

        $validatedData = $request->validate([
            'nazwa' => 'required',
            'miejsce' => 'required',
        ]);

        $kategoria = new kategoriePotraw();
        $kategoria->nazwa = $validatedData['nazwa'];
        $kategoria->miejsce_realizacji = $validatedData['miejsce'];
        $kategoria->save();

        return redirect()->route('ListaKategorii')->with('success', 'Kategoria została zaktualizowana.');
    }

    public function edit($id){
        $kategorie = kategoriePotraw::find($id);

        return view('kategorie.edit',compact('kategorie'));

    }

    public function update(Request $request, $id)
    {
        $kategoria = KategoriePotraw::find($id);

        if (!$kategoria) {
            return redirect()->route('ListaKategorii')->with('error', 'Nie znaleziono kategorii.');
        }

        $validatedData = $request->validate([
            'nazwa' => 'required',
            'kategoria' => 'required|in:bar,kuchnia',
        ]);

        $kategoria->nazwa = $validatedData['nazwa'];

        $miejsceRealizacjiId = $validatedData['kategoria'] == 'bar' ? 2 : 1; // Załóżmy, że 'bar' ma id = 2, 'kuchnia' ma id = 1
        $kategoria->miejsce_realizacji = $miejsceRealizacjiId;

        $kategoria->save();

        return redirect()->route('ListaKategorii')->with('success', 'Kategoria została zaktualizowana.');
    }


    public function destroy($id)
    {
        $kategoria = kategoriePotraw::find($id);

        if (!$kategoria) {
            return redirect()->route('ListaKategorii')->with('error', 'Nie znaleziono kategorii.');
        }


        if ($kategoria->potrawy()->exists()) {
            return redirect()->route('ListaKategorii')->with('error', 'Nie można usunąć kategorii, ponieważ istnieją przypisane potrawy.');
        }


        $kategoria->delete();

        $lista_kategorii = kategoriePotraw::all();
        $miejsce = MiejsceRealizacji::all();
        return view('kategorie.index', compact('lista_kategorii', 'miejsce'))->with('success', 'Kategoria została usunięta.');
    }
}


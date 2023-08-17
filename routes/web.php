<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PracownicyController;
use App\Http\Controllers\StanowiskaController;
use App\Http\Controllers\ZamowieniaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Potrawy\PotrawyController;
use App\Http\Controllers\Kategorie\KategorieController;
use App\Http\Controllers\Stoliki\StolikiController;
use App\Http\Controllers\Rezerwacje\RezerwacjaController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get("/login",[LoginController::class,'succeslogin']);
Route::get('/zamowienia',[ZamowieniaController::class,'index']);
Route::get('/main', function () {
    return view('main.index');
});

Route::get('/', [HomeController::class,'index']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Lista pracowników
Route::get('/pracownicy',[PracownicyController::class,'index'])->name('pracownicy.index');
Route::get('pracownik/{id}/edit',[PracownicyController::class,'edit'])->name('pracownik.edit');
Route::delete('pracownik/{id}/destroy',[PracownicyController::class,'destroy'])->name('pracownik.destroy');
Route::put('/pracownik/{user}', [PracownicyController::class, 'update'])->name('pracownik.update');

//Lista stanowisk
Route::get('/stanowiska',[StanowiskaController::class,'index'])->name('stanowiska.index');

//Lista potraw
Route::get('/potrawy',[PotrawyController::class,'index'])->name('ListaPotraw');

//Lista kategorii potraw
Route::get('/kategorie',[KategorieController::class,'index'])->name('ListaKategorii');
Route::get('/kategoria/edit/{id}',[KategorieController::class,'edit'])->name('kategorie.edit');
Route::delete('kategoria/{id}/destroy',[KategorieController::class,'destroy'])->name('kategorie.destroy');
Route::put('/kategoria/{id}',[KategorieController::class,'update'])->name('kategorie.update');
Route::post('/kategoria/add',[KategorieController::class,'store'])->name('kategorie.store');
//Lista stolikow
Route::get('/stoliki',[StolikiController::class,'index'])->name('ListaStolikow');

//Zamowienia
Route::get('/zamowienia/add',[ZamowieniaController::class,'addZamowieniePanel'])->name('Panelzamowienia');

//Rezerwacje
Route::get('/rezerwacja',[RezerwacjaController::class,'index'])->name('rezerwacje.index');
Route::post('rezerwacje/wybor', [RezerwacjaController::class, 'wybor'])->name('rezerwacje.wybor.daty');

Route::get('/listaRezerwacji',[RezerwacjaController::class,'lista'])->name('ListaRezerwacji');

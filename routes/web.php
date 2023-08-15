<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PracownicyController;
use App\Http\Controllers\StanowiskaController;
use App\Http\Controllers\ZamowieniaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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

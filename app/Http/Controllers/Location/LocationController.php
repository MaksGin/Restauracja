<?php

namespace App\Http\Controllers\Location;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LocationController extends Controller
{
    public function setLang($locale): \Illuminate\Http\RedirectResponse
    {
        App::setLocale($locale);
        Session::put("locale",$locale);
        return redirect()->back();
    }
}

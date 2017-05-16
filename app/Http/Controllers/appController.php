<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Session;

class appController extends Controller
{
    public function setLocale($locale){
        Session::put('locale', $locale);
        return back();
    }
}

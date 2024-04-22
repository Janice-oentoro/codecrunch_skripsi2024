<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    public function test() {
        #session()->forget("cart");
        return view('test');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VueController extends Controller
{
    public function index()
    {
        //if (!auth()->check()) 
            //return redirect()->route('login');

        return view('vue');
    }
}
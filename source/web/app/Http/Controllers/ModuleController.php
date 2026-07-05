<?php

namespace App\Http\Controllers;

class ModuleController extends Controller
{
    public function population()
    {
        return view('modules.population');
    }
}
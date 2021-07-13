<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CarbonFootprintCalculatorController extends Controller
{
    public function calculator(){
        return view('calculator.index');
    }
}

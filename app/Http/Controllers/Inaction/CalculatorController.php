<?php

namespace App\Http\Controllers\Inaction;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CalculatorController extends Controller
{
    public function calculate(Request $request)
    {
        $this->validate($request, [
            'weight'  => 'required|numeric|min:0',
            'height'  => 'required|numeric|min:0',
        ]);
        $weight = $request->weight;
        $height = $request->height / 100;

        $bmi = $weight / ($height * $height);
        $bmi = round($bmi, 2);
        if($bmi < 18.5) {
            return redirect()->route('boilerplate.calculator')
                ->with('growl', ['Вашият индекс на телесната маса е '. $bmi . '. Състоянието е поднаднормено тегло.', 'warning']);
        }
        if($bmi >= 18.5 && $bmi < 25) {
            return redirect()->route('boilerplate.calculator')
                ->with('growl', ['Вашият индекс на телесната маса е '. $bmi . '. Състоянието е нормално тегло.', 'success']);
        }

        if($bmi >= 25) {
            return redirect()->route('boilerplate.calculator')
                ->with('growl', ['Вашият индекс на телесната маса е '. $bmi . '. Състоянието е  наднормено тегло.', 'error']);
        }
    }
}

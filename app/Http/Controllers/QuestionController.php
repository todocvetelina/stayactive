<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function index()
    {
        return view('questions.index');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'email'  => 'required|email',
            'question' => 'required',
        ]);

        return redirect()->route('questions.index')->with('success', 'Успешно зададохте  въпрос.');
    }
}

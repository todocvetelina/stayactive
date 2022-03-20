<?php

namespace App\Http\Controllers\Inaction;

use App\Http\Controllers\Controller;

use App\Models\Recipe;
use Illuminate\Http\Request;

class RecipeController extends Controller
{
    public function __construct()
    {
        $this->middleware('ability:admin,workouts_crud', [
            'only' => [
                'create',
                'edit',
                'update',
                'destroy'
            ]
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('inaction.recipes.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('inaction.recipes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title'    => 'required',
            'description' => 'required',
            'prep_time'  => 'required|numeric|min:0',
            'cook_time' => 'required|numeric|min:0',
            'servings' => 'required|numeric|min:0',
        ]);

        $recipe = new Recipe;
        $recipe->title = $request->title;
        $recipe->description = $request->description;
        $recipe->prep_time = $request->prep_time;
        $recipe->cook_time = $request->cook_time;
        $recipe->servings = $request->servings;
        $recipe->save();

        return redirect()
            ->route('boilerplate.recipes.index')
            ->with('growl', ['Успех!', 'success']);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function edit(Recipe $recipe)
    {
        return view('inaction.recipes.edit', compact('recipe'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Recipe $recipe)
    {
        $this->validate($request, [
            'title'    => 'required',
            'description' => 'required',
            'prep_time'  => 'required|numeric|min:0',
            'cook_time' => 'required|numeric|min:0',
            'servings' => 'required|numeric|min:0',
        ]);

        $recipe->title = $request->title;
        $recipe->description = $request->description;
        $recipe->prep_time = $request->prep_time;
        $recipe->cook_time = $request->cook_time;
        $recipe->servings = $request->servings;
        $recipe->save();

        return redirect()
            ->route('boilerplate.recipes.index')
            ->with('growl', ['Успех!', 'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function destroy(Recipe $recipe)
    {
        $recipe->delete();
        return;
    }

    public function choose()
    {
        $recipes = Recipe::all();
        return view('inaction.recipes.choose', compact('recipes'));
    }

    public function postChoose(Request $request)
    {
        $this->validate($request, [
            'recipe'    => 'required'
        ]);

        $user = auth()->user();
        $user->recipes()->attach([
            $request->recipe => ['date' => $request->date]
        ]);

        return redirect()
            ->route('boilerplate.dashboard')
            ->with('growl', ['Успех!', 'success']);
    }

}

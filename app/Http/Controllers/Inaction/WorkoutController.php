<?php

namespace App\Http\Controllers\Inaction;

use App\Http\Controllers\Controller;

use App\Models\Workout;
use App\Models\Category;
use Illuminate\Http\Request;

class WorkoutController extends Controller
{
    public function __construct()
    {
        $this->middleware('ability:admin,workouts_crud', [
            'only' => [
                'create',
                'edit',
                'update',
                'delete'
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
        return view('inaction.workouts.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('inaction.workouts.create', compact('categories'));
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
            'title'         => 'required',
            'description' => 'required',
            'duration'  => 'required|numeric|min:0',
            'calories_min'  => 'required|numeric|min:0',
            'calories_max'  => 'required|numeric|min:0|gt:calories_min',
            'video' => 'required|url',
            'category' => 'required'
        ]);

        $workout = new Workout;
        $workout->title = $request->title;
        $workout->description = $request->description;
        $workout->duration = $request->duration;
        $workout->category_id = $request->category;
        $workout->video = $request->video;
        $workout->calories_min = $request->calories_min;
        $workout->calories_max = $request->calories_max;
        $workout->save();

        return redirect()
            ->route('boilerplate.workouts.show', $workout->id)
            ->with('growl', ['Успех!', 'success']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Workout  $workout
     * @return \Illuminate\Http\Response
     */
    public function show(Workout $workout)
    {
        return view('inaction.workouts.show', compact('workout'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Workout  $workout
     * @return \Illuminate\Http\Response
     */
    public function edit(Workout $workout)
    {
        $categories = Category::all();
        return view('inaction.workouts.edit', compact('workout', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Workout  $workout
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Workout $workout)
    {
        $this->validate($request, [
            'title'         => 'required',
            'description' => 'required',
            'duration'  => 'required|numeric|min:0',
            'calories_min'  => 'required|numeric|min:0',
            'calories_max'  => 'required|numeric|min:0|gt:calories_min',
            'video' => 'required|url',
            'category' => 'required'
        ]);

        $workout->title = $request->title;
        $workout->description = $request->description;
        $workout->duration = $request->duration;
        $workout->category_id = $request->category;
        $workout->video = $request->video;
        $workout->calories_min = $request->calories_min;
        $workout->calories_max = $request->calories_max;
        $workout->save();

        return redirect()
            ->route('boilerplate.workouts.show', $workout->id)
            ->with('growl', ['Успех!', 'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Workout  $workout
     * @return \Illuminate\Http\Response
     */
    public function destroy(Workout $workout)
    {
        $workout->delete();
        return;
    }

    public function choose()
    {
        $workouts = Workout::all();
        return view('inaction.workouts.choose', compact('workouts'));
    }

    public function postChoose(Request $request)
    {
        $this->validate($request, [
            'workout'    => 'required',
            'start_date'    => 'required|date',
            'end_date'      => 'required|date|after_or_equal:start_date',
        ]);

        $user = auth()->user();
        $user->workouts()->attach([
            $request->workout => [
                'start_date' => $request->start_date,
                'end_date' => $request->end_date
            ]
        ]);

        return redirect()
            ->route('boilerplate.dashboard')
            ->with('growl', ['Успех!', 'success']);
    }
}

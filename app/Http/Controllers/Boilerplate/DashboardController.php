<?php

namespace App\Http\Controllers\Boilerplate;

use App\Http\Controllers\Controller;
use App\Models\Boilerplate\User;
use App\Models\Recipe;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $recipes = auth()->user()->recipes;
        $workouts = auth()->user()->workouts;
        return view('boilerplate::dashboard', compact('recipes', 'workouts'));
    }
}

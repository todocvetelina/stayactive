<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Inaction\CategoryController;
use App\Http\Controllers\Inaction\ArticleController;
use App\Http\Controllers\Inaction\WorkoutController;
use App\Http\Controllers\Inaction\RecipeController;
use App\Http\Controllers\Inaction\CalculatorController;
use App\Models\Article;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Pages
Route::get('/', function () {
    $latestArticles = Article::latest()->take(10)->get();
    return view('welcome', compact('latestArticles'));
});

Route::view('/about', 'about')->name('about');
Route::view('/faq', 'faq')->name('faq');

// Questions
Route::resource('questions', App\Http\Controllers\QuestionController::class)->only('index', 'store');


Route::group([
    'prefix'     => config('boilerplate.app.prefix', ''),
    'domain'     => config('boilerplate.app.domain', ''),
    'middleware' => ['web', 'boilerplate.locale'],
    'as'         => 'boilerplate.',
], function () {

   // Workouts
   Route::get('workouts/choose', [WorkoutController::class, 'choose'])->name('workouts.choose');
   Route::post('workouts/choose', [WorkoutController::class, 'postChoose'])->name('workouts.postChoose');
   Route::resource('workouts', WorkoutController::class);

   // Categories
   Route::resource('categories', CategoryController::class);

   // Articles
   Route::resource('articles', ArticleController::class)->except('show');

   // Recipes
   Route::get('recipes/choose', [RecipeController::class, 'choose'])->name('recipes.choose');
   Route::post('recipes/choose', [RecipeController::class, 'postChoose'])->name('recipes.postChoose');
   Route::resource('recipes', RecipeController::class);

   // Calculator
   Route::view('/calculator', 'inaction.calculator')->name('calculator');
   Route::post('/calculator', [CalculatorController::class, 'calculate'])->name('postCalculator');
});

 // Articles
 Route::resource('articles', App\Http\Controllers\ArticleController::class)->only('index', 'show');
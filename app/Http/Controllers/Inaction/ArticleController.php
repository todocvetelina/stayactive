<?php

namespace App\Http\Controllers\Inaction;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('ability:admin,articles_crud');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('inaction.articles.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('inaction.articles.create');
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
            'subtitle' => 'required',
            'content'  => 'required',
            'read_time' => 'required|numeric|min:0',
            //'featured_image' => 'nullable|mimes:jpeg,jpg,bmp,png'
        ]);

        $article = new Article;
        $article->title = $request->title;
        $article->subtitle = $request->subtitle;
        $article->content = $request->content;
        $article->read_time = $request->read_time;
        $article->save();

        if ($request->hasFile('featured')) {
            $article->addMediaFromRequest('featured')->toMediaCollection('featured');
        }

        return redirect()
            ->route('articles.show', $article->id)
            ->with('growl', ['Успех!', 'success']);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        return view('inaction.articles.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {

        $this->validate($request, [
            'title'         => 'required',
            'subtitle' => 'required',
            'content'  => 'required',
            'read_time' => 'required|numeric|min:0'
        ]);

        $article->title = $request->title;
        $article->subtitle = $request->subtitle;
        $article->content = $request->content;
        $article->read_time = $request->read_time;
                
        $article->save();
        
        if ($request->hasFile('featured')) {
            $article->addMediaFromRequest('featured')->toMediaCollection('featured');
        }

        return redirect()
            ->route('articles.show', $article->id)
            ->with('growl', ['Успех!', 'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        $article->delete();
        return;
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreArticle;
use App\Jobs\ProcessArticle;
use App\Models\Category;
use App\Models\Team;

class TeamArticleController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function create(Team $team)
    {
        return view('teams.articles.create', ['team' => $team, 'categories' => Category::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreArticle  $request
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function store(StoreArticle $request, Team $team)
    {
        $article = $team->articles()->create([
            'category_id' => $request->input('category_id'),
            'path' => $request->file('file')->store('articles')
        ]);
        ProcessArticle::dispatchAfterResponse($article);
        return redirect()->route('teams.show', ['team' => $team])->with('success', 'articles.store');
    }
}

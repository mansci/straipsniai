<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCitation;
use App\Models\Article;

class ArticleCitationController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreCitation  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCitation $request, Article $article)
    {
        $article->citations()->create($request->validated());
        return redirect()->route('articles.show', ['article' => $article])->with('success', 'citation.create');
    }
}

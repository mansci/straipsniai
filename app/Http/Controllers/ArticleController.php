<?php

namespace App\Http\Controllers;

use App\Http\Requests\IndexArticles;
use App\Jobs\ProcessArticle;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Citation;
use Illuminate\Http\Request;
use App\Models\Article;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Article::class, 'article');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        return view('articles.show', compact('article'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        return view('articles.edit', compact('article'));
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
        $article->update([
            'title' => $request->input('title'),
            'author' => $request->input('author'),
            'language' => $request->input('language'),
            'pages' => $request->input('pages'),
        ]);
        return redirect()->route('teams.show', ['team' => $article->team])->with('success', 'article.update');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Article $article
     * @param  \App\Comment $comment
     * @param  \App\Citation $citation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article, Comment $comment, Citation $citation)
    {
        $article->comments()->delete();
        $article->citations()->delete();
        $article->delete();
        return redirect()->route('teams.show', ['team' => $article->team])->with('success', 'article.destroy');
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreComment;
use App\Models\Article;
use App\Models\Comment;

class CommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreComment  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function store(StoreComment $request, Article $article)
    {
        $article->comments()->create($request->validated());
        return redirect()->route('articles.show', ['article' => $article])->with('success', 'comment.create');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article, Comment $comment)
    {
        $comment->delete();
        return redirect()->route('articles.show', ['article' => $article])->with('success', 'comment.destroy');
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreComment;
use App\Models\Citation;
use App\Models\CitationComment;
use Illuminate\Http\Request;

class CitationCommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreComment  $request
     * @param  \App\Models\Citation  $citation
     * @return \Illuminate\Http\Response
     */
    public function store(StoreComment $request, Citation $citation)
    {
        $citation->comments()->create($request->validated());
        return redirect()->route('articles.show', ['article' => $citation->article])->with('success', 'comment.create');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Citation  $citation
     * @param  \App\Models\CitationComment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Citation $citation, CitationComment $comment)
    {
        $comment->delete();
        return redirect()->route('articles.show', ['article' => $citation->article])->with('success', 'comment.destroy');
    }
}

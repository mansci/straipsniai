<?php

namespace App\Http\Controllers;

use App\Models\Citation;
use App\Models\CitationComment;

class CitationController extends Controller
{
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Citation  $citation
     * @param  \App\Models\CitationComment $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Citation $citation, CitationComment $comment)
    {
        $citation->delete();
        return redirect()->route('articles.show', ['article' => $citation->article])->with('success', 'citation.destroy');
    }
}

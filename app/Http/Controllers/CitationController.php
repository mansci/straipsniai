<?php

namespace App\Http\Controllers;

use App\Models\Citation;

class CitationController extends Controller
{
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Citation  $citation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Citation $citation)
    {
        $citation->delete();
        return redirect()->route('articles.show', ['article' => $citation->article])->with('success', 'citation.destroy');
    }
}

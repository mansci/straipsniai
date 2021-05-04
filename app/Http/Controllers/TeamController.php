<?php

namespace App\Http\Controllers;

use App\Http\Requests\IndexArticles;
use App\Http\Requests\StoreTeam;
use App\Models\Article;
use App\Models\Category;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('teams.index', ['teams' => Auth::user()->teams]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreTeam  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTeam $request)
    {
        Auth::user()->teams()->create($request->validated());
        return redirect()->route('teams.index')->with('success', 'team.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Team $team)
    {
        $query = $team->articles();
        if ($request->filled('query')) {
            $like = '%' . $request->query('query') . '%';
            $query = $query
                ->where(function($query) use($like) {
                    $query->where('text', 'like', $like)
                        ->orWhere('author', 'like', '%' . $like)
                        ->orWhere('language', 'like', '%' . $like)
                        ->orWhere('title', 'like', '%' . $like);
                });
        }
        if ($request->filled('category_id')) {
            $query->where('category_id', '=', $request->query('category_id'));
        }
        return view('teams.show', ['team' => $team, 'articles' => $query->get(), 'categories' => Category::all(), 'query' => $request->query('query'), 'category_id' => $request->query('category_id')]);
    }
}

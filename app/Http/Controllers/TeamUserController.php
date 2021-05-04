<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class TeamUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function index(Team $team)
    {
        return view('teams.users.index', ['team' => $team, 'users' => User::all()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Team $team)
    {
        $user = User::find($request->input('user_id'));
        try {
            $team->users()->attach($user);
            return redirect()->route('teams.users.index', ['team' => $team])->with('success', 'user_add');
        } catch (QueryException $e) {
            return redirect()->route('teams.users.index', ['team' => $team])->with('alert', 'team_error');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Team  $team
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(Team $team, User $user)
    {
        $team->users()->detach($user);
        return redirect()->route('teams.users.index', ['team' => $team])->with('success', 'user_remove');
    }
}

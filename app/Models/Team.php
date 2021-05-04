<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    /**
     * Get personal team owner.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the members of this team.
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * Get the articles that belong to this team.
     */
    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    /**
     * Determine if the user belongs to the team.
     *
     * @param User $user User to check
     * @return bool User belongs to team
     */
    public function isMember(User $user) {
        return ($this->user && $this->user->id === $user->id) || $this->users()->find($user->id);
    }
}

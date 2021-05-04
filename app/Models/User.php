<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the personal team the user.
     */
    public function team()
    {
        return $this->hasOne(Team::class);
    }

    /**
     * Get the articles that belomng to this user.
     */
    public function articles()
    {
        return $this->hasManyThrough(Article::class, Team::class);
    }

    /**
     * Get the teams that this user is a member of.
     */
    public function teams()
    {
        return $this->belongsToMany(Team::class);
    }

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::created(function ($user) {
            $user->team()->save(new Team());
        });
    }
}

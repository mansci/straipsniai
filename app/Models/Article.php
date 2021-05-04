<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'path', 'category_id', 'author', 'title', 'pages', 'text', 'language'
    ];
    use HasFactory;


    /**
     * Get the team that the article belongs to.
     */
    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    /**
     * Get the category of this article.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the comments of this article
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Get the citations of this article
     */
    public function citations()
    {
        return $this->hasMany(Citation::class);
    }

}

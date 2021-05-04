<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Citation extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'text'
    ];
    use HasFactory;

    /**
     * Get the article of this citation.
     */
    public function article()
    {
        return $this->belongsTo(Article::class);
    }
}

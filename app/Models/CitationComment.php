<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CitationComment extends Model
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
     * Get the citation of this comment.
     */
    public function citation()
    {
        return $this->belongsTo(Citation::class);
    }
}

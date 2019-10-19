<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['name'];

    public function articles()
    {
        return $this->belongsToMany(Article::class, 'article_tags');
    }

    public function getArticleListAttribute()
    {
        return $this->articles->pluck('id')->toArray();
    }
}

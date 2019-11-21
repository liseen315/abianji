<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Route;

class Tag extends Model
{
    protected $fillable = ['name', 'slug'];

    public function articles()
    {
        return $this->belongsToMany(Article::class, 'article_tags');
    }

    public function getArticleListAttribute()
    {
        return $this->articles->pluck('id')->toArray();
    }

    public function getRouteKeyName()
    {
        if (blog_config('slug') && Route::getCurrentRoute()->getName() == 'home.tags') {
            $name = 'slug';
        } else {
            $name = 'id';
        }

        return $name;
    }

    public function getUrlAttribute()
    {
        if (blog_config('slug')) {
            $parameters[] = $this->slug;
        } else {
            $parameters = [$this->id];
        }

        return url('tags', $parameters);
    }
}

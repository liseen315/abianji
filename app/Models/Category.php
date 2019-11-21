<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Route;

class Category extends Model
{
    protected $fillable = ['name', 'parent_id', 'slug'];


    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function getArticleListAttribute()
    {
        return $this->articles->pluck('id')->toArray();
    }

    public function getRouteKeyName()
    {
        if (blog_config('slug') && Route::getCurrentRoute()->getName() == 'home.category') {
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

        return url('category', $parameters);
    }

}

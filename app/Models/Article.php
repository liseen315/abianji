<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Route;

class Article extends Model
{
    protected $fillable = ['category_id', 'title', 'description', 'slug', 'author_id', 'markdown', 'content', 'cover', 'is_top'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'article_tags')->withTimestamps();
    }


    public function getTagListAttribute()
    {
        return $this->tags->pluck('id')->toArray();
    }

    public function getDesAttribute()
    {
        $des = $this->description . '...';
        if (is_null($this->description)) {
            $des = get_description($this->content);
        }
        return $des;
    }

    public function getRouteKeyName()
    {
        if (blog_config('slug') && (Route::getCurrentRoute()->getName() == 'home.index' || Route::getCurrentRoute()->getName() === 'home.article')) {
            $name = 'slug';
        } else {
            $name = 'id';
        }

        return $name;
    }

    public function getUrlAttribute()
    {
        // 如果启用了slug则文章的url 采用slug返回
        if (blog_config('slug')) {
            $parameters[] = $this->slug;
        } else {
            $parameters = [$this->id];
        }

        return url('article', $parameters);
    }

}

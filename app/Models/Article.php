<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = ['category_id', 'title','slug', 'markdown', 'cover', 'is_top'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags() {
        return $this->belongsToMany(Tag::class,'article_tags')->withTimestamps();
    }

    public function getTagListAttribute()
    {
        return $this->tags->pluck('id')->toArray();
    }
}

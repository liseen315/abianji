<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'parent_id'];


    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

}

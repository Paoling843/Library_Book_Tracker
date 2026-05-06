<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'title',
        'author',
        'category_id',
        'isbn',
        'published_date',
        'description',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}

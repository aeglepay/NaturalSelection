<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'slug', 'title', 'category_id', 'content', 'image',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    // protected $with = [
    //     'category'
    // ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}

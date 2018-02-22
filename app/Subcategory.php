<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'slug',
        'name',
        'category_id'
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function posts()
    {
        return $this->belongsToMany(Post::class, 'post_subcategory', 'subcategory_id', 'post_id');
    }
}

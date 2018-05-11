<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Scenery extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_id',
        'first_post_id',
        'second_post_id',
        'third_post_id',
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    protected $with = ['category', 'firstPost', 'secondPost', 'thirdPost'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function firstPost()
    {
        return $this->belongsTo(Post::class);
    }

    public function secondPost()
    {
        return $this->belongsTo(Post::class);
    }

    public function thirdPost()
    {
        return $this->belongsTo(Post::class);
    }
}
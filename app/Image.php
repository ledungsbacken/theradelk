<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Post;

class Image extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'url'
    ];

    public function posts() {
        return $this->hasMany(Post::class);
    }
}

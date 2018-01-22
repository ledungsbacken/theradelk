<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Post;

class View extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'post_id'
    ];

    public function post() {
        return $this->belongsTo(Post::class);
    }
}

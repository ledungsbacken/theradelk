<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Post;

class HeadImage extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'credits',
        'thumbnail',
        'desktop',
        'tablet',
        'phone',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function posts() {
        return $this->hasMany(Post::class);
    }
}

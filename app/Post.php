<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\User;
use App\HeadImage;
use App\Category;
use App\View;

class Post extends Model
{
    use SoftDeletes;



    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'head_image_id',
        'title',
        'subtitle',
        'content',
        'slug',
        'opacity',
        'is_fullscreen',
        'hidden',
        'published'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function headImage() {
        return $this->belongsTo(HeadImage::class);
    }

    public function views() {
        return $this->hasMany(View::class);
    }

    public function viewsCountRelation() {
        return $this->hasOne(View::class)->selectRaw('post_id, count(id) as count')->groupBy('post_id');
    }

    public function subcategories() {
        return $this->belongsToMany(Subcategory::class, 'post_subcategory', 'post_id', 'subcategory_id');
    }
}

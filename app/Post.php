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

    /**
     * Validation rules for publishing posts.
     *
     * @var array
     */
    public $publishRules = [
        'head_image_id' => 'required',
        'title' => 'required|max:255',
        'subtitle' => 'required|max:255',
        'content' => 'required',
        'subcategories' => 'required',
    ];

    /**
     * Custom validation messages.
     *
     * @var array
     */
    public $validationMessages = [
        'head_image_id.required' => 'Head image is required.',
        'subcategories.required' => 'Category is required.',
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
        return $this->hasOne(View::class)->selectRaw('post_id, count(id) as count')->groupBy('post_id')->withDefault([
            'count' => 0,
        ]);
    }

    public function subcategories() {
        return $this->belongsToMany(Subcategory::class, 'post_subcategory', 'post_id', 'subcategory_id');
    }

    /**
     * @param Request $request
     * @return Post
     */
    public static function indexByUser($userId, $count = 0) {
        $posts = Post::with(['subcategories.category', 'user', 'headImage', 'viewsCountRelation']);
        $posts->whereNotNull('published');
        $posts->where('user_id', '=', (int)$userId);
        $posts->orderBy('id', 'DESC');

        $posts = $posts->paginate((int)$count);
        return $posts;
    }
}
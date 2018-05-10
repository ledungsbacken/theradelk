<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SocialLinkType extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'label',
        'description',
    ];
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    public function socialLink() {
        return $this->hasMany(SocialLink::class);
    }
}

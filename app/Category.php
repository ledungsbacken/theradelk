<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'slug',
        'name'
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    public function subcategories()
    {
        return $this->HasMany(Subcategory::class);
    }

    public function scenery()
    {
        return $this->HasOne(Scenery::class);
    }
}
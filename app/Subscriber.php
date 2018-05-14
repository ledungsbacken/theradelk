<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
    ];

    /**
     * Validation rules.
     *
     * @var array
     */
    public $rules = [
        'email' => 'required|email|unique:subscribers|max:255',
    ];

    /**
     * Validation messages.
     *
     * @var array
     */
    public $messages = [
        // 'email.unique' => '',
    ];
}

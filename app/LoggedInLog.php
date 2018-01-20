<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\User;

class LoggedInLog extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'created_at',
        'updated_at'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserMeta extends Model
{
    protected $table = 'user_meta';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'meta',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'user_id' => 'integer',
        'meta'    => 'array',
    ];

    /**
     * The attributes to be appended.
     *
     * @var array
     */
    // protected $with = [
    //     'user'
    // ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

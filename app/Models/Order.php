<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'option', 'brands', 'duration', 'frequency', 'cycle', 'status'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'user_id' => 'integer',
        'brands'  => 'array',
    ];

    /**
     * The attributes that are mass assignable.
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

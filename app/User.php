<?php

namespace App;

use App\Models\UserMeta;
use App\Models\Order;
use App\Models\Payment;
use Laravel\Cashier\Billable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'phone', 'password', 'role', 'active', 'bio', 'avatar'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'active' => 'boolean'
    ];

    /**
     * The attributes to be appended.
     *
     * @var array
     */
    protected $with = [
        'meta', 'orders', 'payments'
    ];

    function meta()
    {
        return $this->hasOne(UserMeta::class);
    }

    function orders()
    {
        return $this->hasMany(Order::class);
    }

    function payments()
    {
        return $this->hasMany(Payment::class);
    }
}

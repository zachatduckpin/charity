<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    public $appends = ['api_photo'];

    protected $fillable = [
        'name',
        'email',
        'photo',
        'phone',
        'country',
        'city',
        'email_verified',
        'verification_link',
        'address',
        'status',
        'zip',
        'password',
        "balance",
        "total_withdraw",

    ];

    
    public function campaigns()
    {
        return $this->hasMany(Campaign::class);
    }

    public function donations()
    {
        return $this->hasMany(Donation::class,'user_id','id');
    }


    public function getApiPhotoAttribute()
    {
        return getPhoto($this->photo, 'user');
    }

    public function withdraws()
    {
        return $this->hasMany(Withdraw::class);
    }


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
}

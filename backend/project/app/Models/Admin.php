<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */

    protected $guard_name = 'admin';
    protected $fillable = [
        'name',
        'email',
        'email_verify_token',
        'phone',
        'status',
        'role_id',
        'photo',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    public function role_data()
    {
        return $this->belongsTo(Role::class, 'role', 'name')->withDefault();
    }

    public function sectionCheck($value)
    {
        
        if(!$this->role_data->section) {
           $sections = [];
        }else{
            $sections = json_decode($this->role_data->section, true);
        }
  
        if (in_array($value, $sections)) {
            return true;
        } else {
            return false;
        }
    }

}

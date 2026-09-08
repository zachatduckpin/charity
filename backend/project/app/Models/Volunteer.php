<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Volunteer extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $appends = ['api_photo'];
    public function getApiPhotoAttribute()
    {
        return getPhoto($this->photo, 'photo');
    }
}

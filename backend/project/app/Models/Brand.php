<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    // timestamps
    public $timestamps = false;

    public $appends = ['api_photo'];

    public function getApiPhotoAttribute()
    {
        return getPhoto($this->photo, 'brand');
    }
}

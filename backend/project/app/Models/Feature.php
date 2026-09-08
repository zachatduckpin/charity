<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    use HasFactory;
    // timestamps
    public $timestamps = false;
    protected $appends = ['api_photo'];


    public function getApiPhotoAttribute()
    {
        return getPhoto($this->photo, 'feature');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    protected $appends = ['api_photo'];
    public $timestamps = false;
    protected $fillable = [
        'name',
        'slug',
        'status'
    ];

    public function campaign()
    {
        return $this->hasMany(Blog::class, 'category_id', 'id');
    }



    public function getApiPhotoAttribute()
    {
        return getPhoto($this->photo, 'category');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $appends = ['api_photo'];
    protected $fillable = ['title', 'category_id', 'photo', 'slug', 'description', 'source', 'views', 'updated_at', 'status', 'meta_tag', 'meta_description', 'tags'];

    public function category()
    {
        return $this->belongsTo(BlogCategory::class)->withDefault();
    }

    public function comments()
    {
        return $this->hasMany(BlogComment::class)->orderby('id', 'desc');
    }

    public function getApiPhotoAttribute()
    {
        return getPhoto($this->photo, 'blog');
    }
}

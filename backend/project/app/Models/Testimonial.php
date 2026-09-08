<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;
    public $timestamps = false;
    // table
    protected $table = 'testimonials';
    protected $appends = ['api_photo'];
    public function getApiPhotoAttribute()
    {
        return getPhoto($this->photo, 'feature');
    }
}

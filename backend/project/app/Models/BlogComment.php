<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogComment extends Model
{
    use HasFactory;
    // timestamp
    public $timestamps = false;
    public $appends = ['api_date'];

    public function blog() {
        return $this->belongsTo(Blog::class)->withDefault();
    }

    public function getApiDateAttribute() {
        return date('d M Y', strtotime($this->created_at));
    }
}

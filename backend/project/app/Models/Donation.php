<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;
    public $appends = ['api_date'];

    public function campaign()
    {
        return $this->belongsTo(Campaign::class, 'campaign_slug', 'slug')->withDefault();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id')->withDefault();
    }
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id', 'id')->withDefault();
    }

    public function getApiDateAttribute() {
        return $this->created_at->format('Y-m-d');
    }

   
}

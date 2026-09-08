<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CampaignFaq extends Model
{
    use HasFactory;

    // timestamp
    public $timestamps = false;
    // fillable
    protected $fillable = [
        'campaign_id',
        'title',
        'content',
    ];
}

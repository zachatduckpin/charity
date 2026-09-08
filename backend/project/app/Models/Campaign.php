<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Campaign extends Model
{
    use HasFactory;

    protected $appends = ['api_photo', 'founded', 'sort_details'];

    public function faqs()
    {
        return $this->hasMany(CampaignFaq::class);
    }

    public function galleries()
    {
        return $this->hasMany(CampaignGallery::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getApiPhotoAttribute()
    {
        return getPhoto($this->photo, 'campaign');
    }

    public function getSortDetailsAttribute()
    {
        $rvalue = empty($this->description) && !is_numeric($this->description) ? null : trim(strip_tags($this->description));
        return Str::limit($rvalue, 700);
    }

    public function getFoundedAttribute()
    {
        $goal = $this->goal;
        $raised = $this->raised;
        if ($raised == 0) {
            return 0;
        }
        $founded = ($raised / $goal) * 100;
        return round($founded, 2);

    }
}

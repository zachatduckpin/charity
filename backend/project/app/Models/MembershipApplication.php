<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MembershipApplication extends Model
{
    protected $casts = [
        'submitted_at' => 'datetime',
    ];

    public function attachments(): HasMany
    {
        return $this->hasMany(MembershipApplicationAttachment::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DashboardWorkspacePage extends Model
{
    protected $fillable = [
        'slug',
        'title',
        'eyebrow',
        'description',
        'view',
        'data',
        'is_active',
    ];

    protected $casts = [
        'data' => 'array',
        'is_active' => 'boolean',
    ];
}

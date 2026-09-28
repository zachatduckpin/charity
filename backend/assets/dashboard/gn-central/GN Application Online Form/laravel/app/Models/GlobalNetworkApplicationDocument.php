<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GlobalNetworkApplicationDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        'global_network_application_id',
        'document_type',
        'original_name',
        'path',
        'mime_type',
        'size',
    ];

    public function application(): BelongsTo
    {
        return $this->belongsTo(GlobalNetworkApplication::class, 'global_network_application_id');
    }
}


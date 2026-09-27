<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PreWeddingPhoto extends Model
{
    use HasFactory;

    protected $fillable = [
        'wedding_setting_id',
        'photo_path',
        'caption',
        'display_order',
    ];

    public function weddingSetting(): BelongsTo
    {
        return $this->belongsTo(WeddingSetting::class);
    }
}

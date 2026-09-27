<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class WeddingSetting extends Model
{
    use HasFactory;

    protected static function booted(): void
    {
        static::creating(function (WeddingSetting $wedding): void {
            if (filled($wedding->slug)) {
                return;
            }

            $baseSlug = Str::slug(implode('-', array_filter([
                $wedding->groom_name_en,
                $wedding->bride_name_en,
                $wedding->wedding_datetime?->format('Y'),
            ]))) ?: 'wedding';
            $slug = $baseSlug;
            $suffix = 2;

            while (static::query()->where('slug', $slug)->exists()) {
                $slug = $baseSlug . '-' . $suffix++;
            }

            $wedding->slug = $slug;
        });
    }

    protected $fillable = [
        'user_id',
        'groom_name_kh',
        'groom_name_en',
        'bride_name_kh',
        'bride_name_en',
        'wedding_date_kh',
        'wedding_datetime',
        'location_name',
        'location_map_url',
        'bank_aba_account',
        'bank_acleda_account',
        'qr_code_image',
        'groom_photo',
        'bride_photo',
        'groom_bio',
        'bride_bio',
        'wedding_logo',
        'krong_pali_time',
        'krong_pali_desc',
        'hair_cutting_time',
        'hair_cutting_desc',
        'knot_tying_time',
        'knot_tying_desc',
        'evening_reception_time',
        'evening_reception_desc',
        'krong_pali_icon',
        'hair_cutting_icon',
        'knot_tying_icon',
        'evening_reception_icon',
        'additional_ceremonies',
        'background_audio_file',
        'flower_effect_style',
        'enable_aba',
        'aba_account_usd',
        'aba_account_khr',
        'aba_account_name',
        'enable_acleda',
        'acleda_account_usd',
        'acleda_account_khr',
        'acleda_account_name',
        'enable_wing',
        'wing_account_usd',
        'wing_account_khr',
        'wing_account_name',
        'primary_color',
        'secondary_color',
        'background_image',
        'force_background_style',
        'groom_bio_text',
        'bride_bio_text',
    ];

    protected $casts = [
        'wedding_datetime' => 'datetime',
        'additional_ceremonies' => 'array',
        'enable_aba' => 'boolean',
        'enable_acleda' => 'boolean',
        'enable_wing' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function preWeddingPhotos(): HasMany
    {
        return $this->hasMany(PreWeddingPhoto::class)->orderBy('display_order');
    }
}

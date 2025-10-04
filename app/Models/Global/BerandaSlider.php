<?php

namespace App\Models\Global;

use App\Traits\HandleLanguage;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class BerandaSlider extends Model
{
    /** @use HasFactory<\Database\Factories\BerandaSliderFactory> */
    use HasFactory, HasUuids, HandleLanguage;
    protected $guarded = ['id'];

    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        // Clear cache when creating new slider
        static::created(function ($slider) {
            self::clearBerandaSliderCache($slider);
        });

        // Clear cache when updating slider
        static::updated(function ($slider) {
            self::clearBerandaSliderCache($slider);
        });

        // Clear cache when deleting slider
        static::deleted(function ($slider) {
            self::clearBerandaSliderCache($slider);
        });
    }

    /**
     * Clear beranda slider related cache
     */
    protected static function clearBerandaSliderCache($slider): void
    {
        // Clear all beranda slider caches
        Cache::tags(['beranda_sliders'])->flush();
    }

    public function scopeFindByLanguageId($query, $languageId)
    {
        return $query->where('language_id', $languageId);
    }
    
    public function language()
    {
        return $this->belongsTo(Language::class, 'language_id', 'id');
    }
}

<?php

namespace App\Models\Global;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Language extends Model
{
    /** @use HasFactory<\Database\Factories\LanguageFactory> */
    use HasFactory, HasUuids;
    protected $guarded = ['id'];

    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        // Clear cache when creating new language
        static::created(function ($language) {
            self::clearLanguageRelatedCache($language);
        });

        // Clear cache when updating language
        static::updated(function ($language) {
            self::clearLanguageRelatedCache($language);
        });

        // Clear cache when deleting language
        static::deleted(function ($language) {
            self::clearLanguageRelatedCache($language);
        });
    }

    /**
     * Clear language related cache
     */
    protected static function clearLanguageRelatedCache($language): void
    {
        Cache::tags(['languages'])->flush();
    }

    /**
     * Relationship with BerandaSlider
     */
    public function berandaSliders()
    {
        return $this->hasMany(BerandaSlider::class, 'language_id', 'id');
    }
}

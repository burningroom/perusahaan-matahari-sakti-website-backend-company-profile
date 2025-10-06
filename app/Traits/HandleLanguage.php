<?php

namespace App\Traits;

use App\Models\Global\Language;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Request;

trait HandleLanguage
{
    /**
     * Get active language based on request header or default
     */
    public function getActiveLanguage(): Language
    {
        $cacheKey = "languages";
        Cache::tags(['languages'])->flush();
        return Cache::tags(['languages'])->remember($cacheKey, 3600, function () {
            $language = Language::where('is_active', true)
                ->first();
            if (!$language) {
                $language = Language::where('code', 'id')
                    ->first();
            }
            return $language;
        });
    }

    /**
     * Get all active languages with caching
     */
    public function getActiveLanguages()
    {
        return Cache::remember('active_languages', 3600, function () {
            return Language::where('is_active', true)
                ->orderBy('name')
                ->get();
        });
    }

    /**
     * Clear language cache
     */
    public function clearLanguageCache(): void
    {
        Cache::forget('active_languages');

        // Clear specific language caches
        $languages = Language::where('is_active', true)->get();
        foreach ($languages as $language) {
            Cache::forget("language:{$language->code}");
        }
    }

    /**
     * Scope query by active language
     */
    public function scopeByActiveLanguage($query)
    {
        $activeLanguage = $this->getActiveLanguage();
        return $query->where('language_id', $activeLanguage->id);
    }

    /**
     * Scope query by specific language code
     */
    public function languageByCode(string $languageCode)
    {
        $cacheKey = "language:{$languageCode}";

        return Cache::remember($cacheKey, 3600, function () use ($languageCode) {
            return Language::where('code', $languageCode)
                ->first();
        });

    }
}
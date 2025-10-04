<?php
namespace App\Services;

use App\Exceptions\HandledException;
use App\Models\Global\Language;
use Illuminate\Support\Facades\DB;

class LanguageService
{
    /**
     * Get the currently active language
     *
     * @return Language|null
     */
    public function getActiveLang(): ?Language
    {
        return Language::where('is_active', true)->first();
    }

    /**
     * Set active language by code
     *
     * @param string $code Language code (id, en, zh)
     * @return Language The activated language model
     * @throws HandledException When language code is invalid or not found
     */
    public function setActiveLang(string $code): Language
    {
        // Validate if language exists in database
        $language = Language::where('code', $code)->first();
        
        if (!$language) {
            throw new HandledException('Code language tidak valid atau tidak ditemukan');
        }

        // Use database transaction to ensure data consistency
        return DB::transaction(function () use ($language) {
            // Deactivate all languages
            Language::where('is_active', true)->update([
                'is_active' => false
            ]);

            // Activate the selected language
            $language->update([
                'is_active' => true
            ]);

            // Refresh the model to get updated data
            return $language->fresh();
        });
    }

    /**
     * Get all available languages
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllLanguages()
    {
        return Language::all();
    }

    /**
     * Get available language codes
     *
     * @return array
     */
    public function getAvailableLanguageCodes(): array
    {
        return Language::pluck('code')->toArray();
    }
}
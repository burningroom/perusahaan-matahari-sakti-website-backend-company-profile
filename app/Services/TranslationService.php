<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Exception;

class TranslationService
{
    private const GOOGLE_TRANSLATE_URL = 'https://translate.googleapis.com/translate_a/single';
    private const GOOGLE_DETECT_URL = 'https://translate.googleapis.com/translate_a/single';
    
    /**
     * Detect the language of given text
     *
     * @param string $text
     * @return string
     */
    public function detectLanguage(string $text): string
    {
        try {
            if (empty(trim($text))) {
                return 'id'; 
            }

            $response = Http::timeout(30)->get(self::GOOGLE_DETECT_URL, [
                'client' => 'gtx',
                'sl' => 'auto', 
                'tl' => 'en', 
                'dt' => 't',
                'q' => $text
            ]);

            if ($response->successful()) {
                $data = $response->json();
                
                if (isset($data[2])) {
                    return $data[2]; // Detected source language
                }
            }

            Log::warning('Language detection failed', [
                'text' => $text,
                'response' => $response->body()
            ]);

            return 'id'; // Default to Indonesian if detection fails
            
        } catch (Exception $e) {
            Log::error('Language detection error', [
                'message' => $e->getMessage(),
                'text' => $text
            ]);
            
            return 'id'; // Default to Indonesian if error occurs
        }
    }

    /**
     * Translate text with automatic source language detection
     *
     * @param string $text
     * @param string $targetLanguage ('en' for English, 'zh' for Chinese)
     * @param string|null $sourceLanguage (optional, will auto-detect if null)
     * @return string
     */
    public function translateText(string $text, string $targetLanguage, ?string $sourceLanguage = null): string
    {
        try {
            if (empty(trim($text))) {
                return '';
            }

            // Auto-detect source language if not provided
            if ($sourceLanguage === null) {
                $sourceLanguage = $this->detectLanguage($text);
            }

            // Use Google Translate free API
            $response = Http::timeout(30)->get(self::GOOGLE_TRANSLATE_URL, [
                'client' => 'gtx',
                'sl' => $sourceLanguage, // source language (auto-detected or provided)
                'tl' => $targetLanguage, // target language
                'dt' => 't',
                'q' => $text
            ]);

            if ($response->successful()) {
                $data = $response->json();
                
                if (isset($data[0][0][0])) {
                    return $data[0][0][0];
                }
            }

            Log::warning('Translation API failed', [
                'text' => $text,
                'source_language' => $sourceLanguage,
                'target_language' => $targetLanguage,
                'response' => $response->body()
            ]);

            return $text; // Return original text if translation fails
            
        } catch (Exception $e) {
            Log::error('Translation service error', [
                'message' => $e->getMessage(),
                'text' => $text,
                'source_language' => $sourceLanguage,
                'target_language' => $targetLanguage
            ]);
            
            return $text; // Return original text if error occurs
        }
    }
    
    /**
     * Translate text from Indonesian to target language (legacy method)
     *
     * @param string $text
     * @param string $targetLanguage ('en' for English, 'zh' for Chinese)
     * @return string
     */
    public function translateFromIndonesian(string $text, string $targetLanguage): string
    {
        return $this->translateText($text, $targetLanguage, 'id');
    }

    /**
     * Translate text to English with auto-detection
     *
     * @param string $text
     * @param string|null $sourceLanguage (optional, will auto-detect if null)
     * @return string
     */
    public function translateToEnglish(string $text, ?string $sourceLanguage = null): string
    {
        return $this->translateText($text, 'en', $sourceLanguage);
    }

    /**
     * Translate text to Chinese with auto-detection
     *
     * @param string $text
     * @param string|null $sourceLanguage (optional, will auto-detect if null)
     * @return string
     */
    public function translateToChinese(string $text, ?string $sourceLanguage = null): string
    {
        return $this->translateText($text, 'zh', $sourceLanguage);
    }

    /**
     * Translate multiple texts at once with auto-detection
     *
     * @param array $texts
     * @param string $targetLanguage
     * @param string|null $sourceLanguage (optional, will auto-detect if null)
     * @return array
     */
    public function translateMultiple(array $texts, string $targetLanguage, ?string $sourceLanguage = null): array
    {
        $translations = [];
        
        foreach ($texts as $key => $text) {
            $translations[$key] = $this->translateText($text, $targetLanguage, $sourceLanguage);
        }
        
        return $translations;
    }

    /**
     * Get all translations for a text (English and Chinese) with auto-detection
     *
     * @param string $text
     * @param string|null $sourceLanguage (optional, will auto-detect if null)
     * @return array
     */
    public function getAllTranslations(string $text, ?string $sourceLanguage = null): array
    {
        return [
            'en' => $this->translateToEnglish($text, $sourceLanguage),
            'zh' => $this->translateToChinese($text, $sourceLanguage)
        ];
    }

    /**
     * Get translation info including detected source language
     *
     * @param string $text
     * @param string $targetLanguage
     * @return array
     */
    public function getTranslationInfo(string $text, string $targetLanguage): array
    {
        $detectedLanguage = $this->detectLanguage($text);
        $translation = $this->translateText($text, $targetLanguage, $detectedLanguage);
        
        return [
            'original_text' => $text,
            'detected_language' => $detectedLanguage,
            'target_language' => $targetLanguage,
            'translated_text' => $translation
        ];
    }
}
<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SetActiveLanguageRequest;
use App\Services\LanguageService;
use App\Traits\HandleResponseApi;
use App\Traits\HandleLog;
use Exception;

class LanguageController extends Controller
{
    use HandleResponseApi, HandleLog;

    protected LanguageService $languageService;

    public function __construct(LanguageService $languageService)
    {
        $this->languageService = $languageService;
    }

    /**
     * Get the currently active language
     */
    public function getActiveLanguage()
    {
        try {
            $activeLanguage = $this->languageService->getActiveLang();
            
            return $this->sendResponse($activeLanguage, 'Active language retrieved successfully');
        } catch (Exception $e) {
            $this->makeLog($e, 'error', 'GET_ACTIVE_LANGUAGE_ERROR');
            return $this->sendError('Failed to retrieve active language', [], 500);
        }
    }

    /**
     * Get all available languages
     */
    public function getAllLanguages()
    {
        try {
            $languages = $this->languageService->getAllLanguages();
            
            return $this->sendResponse($languages, 'Languages retrieved successfully');
        } catch (Exception $e) {
            $this->makeLog($e, 'error', 'GET_ALL_LANGUAGES_ERROR');
            return $this->sendError('Failed to retrieve languages', [], 500);
        }
    }

    /**
     * Set active language
     */
    public function setActiveLanguage(SetActiveLanguageRequest $request)
    {
        try {
            $language = $this->languageService->setActiveLang($request->validated()['code']);
            
            return $this->sendResponse($language, 'Language activated successfully');
        } catch (Exception $e) {
            $this->makeLog($e, 'error', 'SET_ACTIVE_LANGUAGE_ERROR');
            return $this->sendError($e->getMessage(), [], 400);
        }
    }

    /**
     * Get available language codes
     */
    public function getAvailableLanguageCodes()
    {
        try {
            $codes = $this->languageService->getAvailableLanguageCodes();
            
            return $this->sendResponse($codes, 'Language codes retrieved successfully');
        } catch (Exception $e) {
            $this->makeLog($e, 'error', 'GET_AVAILABLE_LANGUAGE_CODES_ERROR');
            return $this->sendError('Failed to retrieve language codes', [], 500);
        }
    }
}
<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Global\BerandaSlider;
use App\Models\Global\Language;
use App\Traits\HandleLanguage;
use App\Traits\HandleResponseApi;
use App\Traits\HandleLog;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class BerandaSliderController extends Controller
{
    use HandleResponseApi, HandleLanguage, HandleLog;

    /**
     * Display a listing of beranda sliders based on active language.
     */
    public function index(Request $request)
    {
        try {
            $lang = $request->input('lang', 'id');
            $activeLanguage = $this->languageByCode($lang);
            $cacheKey = "beranda_sliders_active_{$activeLanguage->code}";
            $sliders = Cache::tags(['beranda_sliders', 'language_' . $activeLanguage->code])
                ->remember($cacheKey, 1800, function () use ($activeLanguage) {
                    return BerandaSlider::with('language')
                        ->findByLanguageId($activeLanguage?->id)
                        ->orderBy('sort_number')
                        ->get()
                        ->map(function ($slider) {
                            return [
                                'id' => $slider->id,
                                'title' => $slider->title,
                                'description' => $slider->description,
                                'media' => $slider->media ? url(Storage::url($slider->media)) : null,
                                'sort_number' => $slider->sort_number,
                                'language' => [
                                    'id' => $slider->language->id,
                                    'name' => $slider->language->name,
                                    'code' => $slider->language->code,
                                ],
                                'created_at' => $slider->created_at,
                                'updated_at' => $slider->updated_at,
                            ];
                        });
                });

            return $this->sendResponse($sliders, 'Beranda sliders retrieved successfully');
        } catch (Exception $e) {
            $this->makeLog($e, 'error', 'GET_BERANDA_SLIDERS_ERROR');
            return $this->sendError('Failed to retrieve beranda sliders', [], 500);
        }
    }

    /**
     * Display the specified beranda slider.
     */
    public function show(string $id)
    {
        try {
            $cacheKey = "beranda_slider_{$id}";

            $slider = Cache::tags(['beranda_sliders', 'slider_' . $id])
                ->remember($cacheKey, 1800, function () use ($id) {
                    return BerandaSlider::with('language')->find($id);
                });

            if (!$slider) {
                return $this->sendError('Beranda slider not found', [], 404);
            }

            // Check if the slider's language is active
            if (!$slider->language->is_active) {
                return $this->sendError('Slider language is not active', [], 404);
            }

            return $this->sendResponse($slider, 'Beranda slider retrieved successfully');

        } catch (Exception $e) {
            $this->makeLog($e, 'error', 'GET_BERANDA_SLIDER_ERROR');
            return $this->sendError('Failed to retrieve slider', [], 500);
        }
    }

}
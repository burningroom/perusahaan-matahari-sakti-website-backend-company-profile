<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BerandaSliderController;
use App\Http\Controllers\Api\LanguageController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('beranda-sliders')->name('beranda-sliders.')->group(function () {
    Route::get('/', [BerandaSliderController::class, 'index'])->name('index');
    Route::get('/{id}', [BerandaSliderController::class, 'show'])->name('show');
});

Route::prefix('languages')->name('languages.')->group(function () {
    Route::get('/', [LanguageController::class, 'getAllLanguages'])->name('index');
    Route::get('/active', [LanguageController::class, 'getActiveLanguage'])->name('active');
    Route::get('/codes', [LanguageController::class, 'getAvailableLanguageCodes'])->name('codes');
    Route::post('/set-active', [LanguageController::class, 'setActiveLanguage'])->name('set-active');
});
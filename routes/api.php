<?php

use App\Http\Controllers\PublicApiController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1/public')->group(function () {

    Route::get('/regions', [PublicApiController::class, 'regions'])
        ->name('api.public.regions');

    Route::get('/rtlh', [PublicApiController::class, 'rtlh'])
        ->name('api.public.rtlh');

    Route::get('/rtlh/{house}', [PublicApiController::class, 'show'])
        ->name('api.public.rtlh.show');

    Route::get('/statistics', [PublicApiController::class, 'statistics'])
        ->name('api.public.statistics');

});


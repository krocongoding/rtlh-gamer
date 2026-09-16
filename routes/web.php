<?php

use App\Http\Controllers\HouseController;
use App\Http\Controllers\HouseConditionController;
use App\Http\Controllers\HouseSanitationUtilityController;
use App\Http\Controllers\HouseOccupantController;
use App\Http\Controllers\HouseAssessmentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PublicRtlhController;
use App\Models\House;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegionController;

Route::get('/', [PublicRtlhController::class, 'index'])
    ->name('public.rtlh.index');

Route::get('/data-rtlh', [PublicRtlhController::class, 'index'])
    ->name('public.rtlh.data');

Route::get('/data-rtlh/download', [PublicRtlhController::class, 'download'])
    ->name('public.rtlh.download');

Route::get('/data-rtlh/{house}', [PublicRtlhController::class, 'show'])
    ->name('public.rtlh.show');

Route::middleware(['auth'])->group(function (){  

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');
});
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

Route::get('/houses/{house}/condition', [HouseConditionController::class, 'edit'])
    ->name('houses.condition.edit')
    ->can('update', 'house');

Route::put('/houses/{house}/condition', [HouseConditionController::class, 'update'])
    ->name('houses.condition.update')
    ->can('update', 'house');

Route::get(
    '/houses/{house}/sanitation-utility',
    [HouseSanitationUtilityController::class, 'edit']
)
    ->name('houses.sanitation-utility.edit')
    ->can('update', 'house');

Route::put(
    '/houses/{house}/sanitation-utility',
    [HouseSanitationUtilityController::class, 'update']
)
    ->name('houses.sanitation-utility.update')
    ->can('update', 'house');
});

Route::get('/test-admin', function () {
    return 'Admin OK';
})->middleware(['auth', 'role:admin']);

Route::get('/test-surveyor', function () {
    return 'Surveyor OK';
})->middleware(['auth', 'role:surveyor']);

Route::middleware('auth')->group(function () {
    Route::get('/houses', [HouseController::class, 'index'])
        ->name('houses.index')
        ->can('viewAny', House::class);

    Route::get('/houses/create', [HouseController::class, 'create'])
        ->name('houses.create')
        ->can('create', House::class);

    Route::post('/houses', [HouseController::class, 'store'])
        ->name('houses.store')
        ->can('create', House::class);
    
    Route::get('/houses/{house}/edit', [HouseController::class, 'edit'])
    ->name('houses.edit')
    ->can('update', 'house');

    Route::put('/houses/{house}', [HouseController::class, 'update'])
    ->name('houses.update')
    ->can('update', 'house');

Route::delete('/houses/{house}', [HouseController::class, 'destroy'])
    ->name('houses.destroy');

    Route::get('/houses/{house}', [HouseController::class, 'show'])
        ->name('houses.show')
        ->can('view', 'house');

    Route::get(
        '/houses/{house}/occupants',
        [HouseOccupantController::class, 'edit'])

        ->name('houses.occupants.edit')
        ->can('update', 'house');

    Route::put(
        '/houses/{house}/occupants',
        [HouseOccupantController::class, 'update'])
    
        ->name('houses.occupants.update')
        ->can('update', 'house');

});

Route::middleware('auth')->group(function () {
    Route::get('/regions', [RegionController::class, 'index'])
        ->name('regions.index');

    Route::get('/regions/create', [RegionController::class, 'create'])
        ->name('regions.create');

    Route::post('/regions', [RegionController::class, 'store'])
        ->name('regions.store');
});

    Route::get(
        '/houses/{house}/assessment',
        [HouseAssessmentController::class, 'edit']
    )->name('houses.assessment.edit');

    Route::put(
        '/houses/{house}/assessment',
        [HouseAssessmentController::class, 'update']
    )->name('houses.assessment.update');


require __DIR__.'/auth.php';

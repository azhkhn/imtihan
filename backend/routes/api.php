<?php

use App\Http\Controllers\API\Admin\Condition\ConditionCategoryController;
use App\Http\Controllers\API\Admin\LanguageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['auth:sanctum'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::apiResource('languages', LanguageController::class);
        Route::prefix('conditions')->group(function () {
            Route::apiResource('categories', ConditionCategoryController::class);
        });
    });
});

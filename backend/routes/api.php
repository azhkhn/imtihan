<?php

use App\Http\Controllers\API\Admin\ClassRoomController;
use App\Http\Controllers\API\Admin\Company\CompanyController;
use App\Http\Controllers\API\Admin\Company\CompanyUserController;
use App\Http\Controllers\API\Admin\Condition\ConditionCategoryController;
use App\Http\Controllers\API\Admin\Condition\ConditionController;
use App\Http\Controllers\API\Admin\LanguageController;
use App\Http\Controllers\API\Admin\LessonController;
use App\Http\Controllers\API\Admin\Payment\PaymentCouponController;
use App\Http\Controllers\API\Admin\Payment\PaymentMethodController;
use App\Http\Controllers\API\Admin\Payment\PaymentSettingController;
use App\Http\Controllers\API\Admin\Post\AnnouncementController;
use App\Http\Controllers\API\Admin\Post\SliderController;
use App\Http\Controllers\API\Admin\Question\QuestionCatergoryController;
use App\Http\Controllers\API\Admin\Question\QuestionController;
use App\Http\Controllers\API\Manager\Booking\BookingController;
use App\Http\Controllers\API\Manager\Booking\BookingSettingController;
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
        Route::apiResources([
            'companies' => CompanyController::class,
            'company/users' => CompanyUserController::class,
        ]);
        Route::apiResource('languages', LanguageController::class);
        Route::apiResource('class-rooms', ClassRoomController::class);
        Route::apiResource('lessons', LessonController::class);
        Route::prefix('payment')->group(function () {
            Route::apiResource('coupons', PaymentCouponController::class);
            Route::apiResource('methods', PaymentMethodController::class);
            Route::apiResource('settings', PaymentSettingController::class);
        });
        Route::prefix('condition')->group(function () {
            Route::apiResource('conditions', ConditionController::class);
            Route::apiResource('categories', ConditionCategoryController::class);
        });

        Route::apiResources([
            'questions' => QuestionController::class,
            'question/categories' => QuestionCatergoryController::class,
        ]);
        Route::prefix('post')->group(function () {
            Route::apiResource('announcements', AnnouncementController::class);
            Route::apiResource('sliders', SliderController::class);
        });
    });

    Route::prefix('manager')->group(function () {
        Route::apiResources([
            'bookings' => BookingController::class,
            'booking/settings' => BookingSettingController::class,
        ]);
        Route::apiResources([
            'post/announcements' => \App\Http\Controllers\API\Manager\Post\AnnouncementController::class,
        ]);
        Route::apiResources([
            'questions' => \App\Http\Controllers\API\Manager\Question\QuestionController::class,
        ]);
    });
});

<?php

use App\Http\Controllers\API\Admin\Announcement\AnnouncementController;
use App\Http\Controllers\API\Admin\ClassRoom\ClassRoomController;
use App\Http\Controllers\API\Admin\Company\CompanyController;
use App\Http\Controllers\API\Admin\Company\CompanyUserController;
use App\Http\Controllers\API\Admin\Condition\ConditionCategoryController;
use App\Http\Controllers\API\Admin\Condition\ConditionController;
use App\Http\Controllers\API\Admin\Language\LanguageController;
use App\Http\Controllers\API\Admin\Lesson\LessonController;
use App\Http\Controllers\API\Admin\Payment\PaymentCouponController;
use App\Http\Controllers\API\Admin\Payment\PaymentMethodController;
use App\Http\Controllers\API\Admin\Payment\PaymentSettingController;
use App\Http\Controllers\API\Admin\Question\QuestionCatergoryController;
use App\Http\Controllers\API\Admin\Question\QuestionController;
use App\Http\Controllers\API\Manager\Booking\BookingController;
use App\Http\Controllers\API\Manager\Booking\BookingSettingController;
use App\Http\Controllers\API\Manager\Lesson\LiveLessonController;
use App\Http\Controllers\API\Manager\Notification\NotificationController;
use App\Http\Controllers\API\User\Support\SupportController;
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
        Route::apiResource('class-rooms', ClassRoomController::class);
        Route::apiResource('lessons', LessonController::class);
        Route::apiResource('announcements', AnnouncementController::class);
        Route::apiResources([
            'companies' => CompanyController::class,
            'company/users' => CompanyUserController::class,
        ]);
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
    });

    Route::prefix('manager')->group(function () {
        Route::apiResource('live-lessons', LiveLessonController::class);
        Route::apiResource('lessons', \App\Http\Controllers\API\Manager\Lesson\LessonController::class);
        Route::apiResource('announcements', \App\Http\Controllers\API\Manager\Announcement\AnnouncementController::class);
        Route::apiResource('questions', \App\Http\Controllers\API\Manager\Question\QuestionController::class);
        Route::apiResource('notifications', NotificationController::class)->only(['index', 'store']);
        Route::get('question/bugs', [\App\Http\Controllers\API\Manager\Question\QuestionController::class, 'getBugList']);
        Route::delete('question/bugs/{question}', [\App\Http\Controllers\API\Manager\Question\QuestionController::class, 'destroyBug']);
        Route::prefix('exam')->group(function () {
            Route::apiResource('classes', \App\Http\Controllers\API\Manager\Exam\ClassExamController::class);
            Route::apiResource('reports', \App\Http\Controllers\API\Manager\Exam\ReportController::class)->only(['index', 'show']);
        });
        Route::apiResources([
            'bookings' => BookingController::class,
            'booking/settings' => BookingSettingController::class,
        ]);
    });

    Route::prefix('teacher')->group(function () {
        Route::apiResource('announcements', \App\Http\Controllers\API\Teacher\Announcement\AnnouncementController::class);
        Route::apiResource('lessons', \App\Http\Controllers\API\Teacher\Lesson\LessonController::class);
        Route::apiResource('live-lessons', \App\Http\Controllers\API\Teacher\Lesson\LiveLessonController::class);
        Route::apiResource('bookings', \App\Http\Controllers\API\Teacher\Booking\BookingController::class)->only(['index', 'show', 'destroy']);
        Route::apiResource('booking/settings', \App\Http\Controllers\API\Teacher\Booking\BookingSettingController::class);
    });

    Route::prefix('user')->group(function () {
        Route::apiResource('bookings', \App\Http\Controllers\API\User\Booking\BookingController::class)->only(['index', 'store', 'destroy']);
        Route::apiResource('supports', SupportController::class)->only(['index', 'store', 'destroy']);
    });
});

<?php

namespace App\Providers;

use App\Models\Announcement;
use App\Models\Booking;
use App\Models\BookingSetting;
use App\Models\LessonByCompany;
use App\Models\LiveLesson;
use App\Models\QuestionByCompany;
use App\Models\Support;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        Booking::class => \App\Policies\Manager\Booking\BookingPolicy::class,
        \App\Policies\Teacher\Booking\BookingPolicy::class,
        \App\Policies\User\Booking\BookingPolicy::class,
        BookingSetting::class => \App\Policies\Manager\Booking\BookingSettingPolicy::class,
        Announcement::class => \App\Policies\Manager\Announcement\AnnouncementPolicy::class,
        LiveLesson::class => \App\Policies\Manager\Lesson\LiveLessonPolicy::class,
        LessonByCompany::class => \App\Policies\Manager\Lesson\LessonByCompanyPolicy::class,
        QuestionByCompany::class => \App\Policies\Manager\Question\QuestionByCompanyPolicy::class,
        Support::class => \App\Policies\User\Support\SupportPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        ResetPassword::createUrlUsing(function ($notifiable, $token) {
            return config('app.frontend_url')."/password-reset/$token?email={$notifiable->getEmailForPasswordReset()}";
        });

        //
    }
}

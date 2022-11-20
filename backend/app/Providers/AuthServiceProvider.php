<?php

namespace App\Providers;

use App\Models\Announcement;
use App\Models\Booking;
use App\Models\BookingSetting;
use App\Models\LiveLesson;
use App\Policies\Manager\Announcement\AnnouncementPolicy;
use App\Policies\Manager\Booking\BookingPolicy;
use App\Policies\Manager\Booking\BookingSettingPolicy;
use App\Policies\Manager\Lesson\LiveLessonPolicy;
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
        Booking::class => BookingPolicy::class,
        BookingSetting::class => BookingSettingPolicy::class,
        Announcement::class => AnnouncementPolicy::class,
        LiveLesson::class => LiveLessonPolicy::class,
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

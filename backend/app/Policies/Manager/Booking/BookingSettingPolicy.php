<?php

namespace App\Policies\Manager\Booking;

use App\Models\BookingSetting;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BookingSettingPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\BookingSetting  $bookingSetting
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, BookingSetting $bookingSetting)
    {
        return $user->info->company_id === $bookingSetting->company_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\BookingSetting  $bookingSetting
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, BookingSetting $bookingSetting)
    {
        return $user->info->company_id === $bookingSetting->company_id;
    }
}

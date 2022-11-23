<?php

namespace App\Policies\Manager\Lesson;

use App\Models\LiveLesson;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class LiveLessonPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\LiveLesson  $liveLesson
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, LiveLesson $liveLesson)
    {
        return $user->info->company_id === $liveLesson->company_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\LiveLesson  $liveLesson
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, LiveLesson $liveLesson)
    {
        return $user->info->company_id === $liveLesson->company_id;
    }
}

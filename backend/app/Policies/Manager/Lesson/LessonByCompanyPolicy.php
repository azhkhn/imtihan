<?php

namespace App\Policies\Manager\Lesson;

use App\Models\LessonByCompany;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class LessonByCompanyPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\LessonByCompany  $lessonByCompany
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, LessonByCompany $lessonByCompany)
    {
        return $user->info->company_id === $lessonByCompany->company_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\LessonByCompany  $lessonByCompany
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, LessonByCompany $lessonByCompany)
    {
        return $user->info->company_id === $lessonByCompany->company_id;
    }
}

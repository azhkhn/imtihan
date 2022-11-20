<?php

namespace App\Policies\Manager\Question;

use App\Models\QuestionByCompany;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class QuestionByCompanyPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\QuestionByCompany  $questionByCompany
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, QuestionByCompany $questionByCompany)
    {
        return $user->info->company_id === $questionByCompany->company_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\QuestionByCompany  $questionByCompany
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function destroy(User $user, QuestionByCompany $questionByCompany)
    {
        return $user->info->company_id === $questionByCompany->company_id;
    }
}

<?php

namespace App\Policies\User\Support;

use App\Models\Support;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SupportPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Support  $support
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Support $support)
    {
        return $user->info->user_id === $support->user_id;
    }
}

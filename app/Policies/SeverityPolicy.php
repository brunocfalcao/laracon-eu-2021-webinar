<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Severity;
use App\Policies\AbstractPolicy;
use Illuminate\Auth\Access\HandlesAuthorization;

class SeverityPolicy extends AbstractPolicy
{
    use HandlesAuthorization;

    protected $uriKey = 'severities';

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return parent::viewAny($user);
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Severity  $severity
     * @return mixed
     */
    public function view(User $user, Severity $severity)
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Severity  $severity
     * @return mixed
     */
    public function update(User $user, Severity $severity)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Severity  $severity
     * @return mixed
     */
    public function delete(User $user, Severity $severity)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Severity  $severity
     * @return mixed
     */
    public function restore(User $user, Severity $severity)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Severity  $severity
     * @return mixed
     */
    public function forceDelete(User $user, Severity $severity)
    {
        return $user->isAdmin();
    }
}

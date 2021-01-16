<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Priority;
use App\Policies\AbstractPolicy;
use Illuminate\Auth\Access\HandlesAuthorization;

class PriorityPolicy extends AbstractPolicy
{
    use HandlesAuthorization;

    protected $uriKey = 'priorities';

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
     * @param  \App\Models\Priority  $priority
     * @return mixed
     */
    public function view(User $user, Priority $priority)
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
     * @param  \App\Models\Priority  $priority
     * @return mixed
     */
    public function update(User $user, Priority $priority)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Priority  $priority
     * @return mixed
     */
    public function delete(User $user, Priority $priority)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Priority  $priority
     * @return mixed
     */
    public function restore(User $user, Priority $priority)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Priority  $priority
     * @return mixed
     */
    public function forceDelete(User $user, Priority $priority)
    {
        return $user->isAdmin();
    }
}

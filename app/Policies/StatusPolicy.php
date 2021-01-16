<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Status;
use App\Policies\AbstractPolicy;
use Illuminate\Auth\Access\HandlesAuthorization;

class StatusPolicy extends AbstractPolicy
{
    use HandlesAuthorization;

    protected $uriKey = 'statuses';

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
     * @param  \App\Models\Status  $status
     * @return mixed
     */
    public function view(User $user, Status $status)
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
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Status  $status
     * @return mixed
     */
    public function update(User $user, Status $status)
    {
        return true;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Status  $status
     * @return mixed
     */
    public function delete(User $user, Status $status)
    {
        return true;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Status  $status
     * @return mixed
     */
    public function restore(User $user, Status $status)
    {
        return true;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Status  $status
     * @return mixed
     */
    public function forceDelete(User $user, Status $status)
    {
        return true;
    }
}

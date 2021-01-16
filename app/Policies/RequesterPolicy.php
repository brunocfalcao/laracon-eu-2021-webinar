<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Requester;
use App\Policies\AbstractPolicy;
use Illuminate\Auth\Access\HandlesAuthorization;

class RequesterPolicy extends AbstractPolicy
{
    use HandlesAuthorization;

    protected $uriKey = 'requesters';

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
     * @param  \App\Models\Requester  $requester
     * @return mixed
     */
    public function view(User $user, Requester $requester)
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
     * @param  \App\Models\Requester  $requester
     * @return mixed
     */
    public function update(User $user, Requester $requester)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Requester  $requester
     * @return mixed
     */
    public function delete(User $user, Requester $requester)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Requester  $requester
     * @return mixed
     */
    public function restore(User $user, Requester $requester)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Requester  $requester
     * @return mixed
     */
    public function forceDelete(User $user, Requester $requester)
    {
        return $user->isAdmin();
    }
}

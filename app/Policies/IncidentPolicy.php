<?php

namespace App\Policies;

use App\Models\Incident;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class IncidentPolicy extends AbstractPolicy
{
    use HandlesAuthorization;

    protected $uriKey = 'incidents';

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Incident  $incident
     * @return mixed
     */
    public function view(User $user, Incident $incident)
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
     * @param  \App\Models\Incident  $incident
     * @return mixed
     */
    public function update(User $user, Incident $incident)
    {
        return optional($incident->user)->id == $user->id ||
               $user->isAdmin() ||
               $user->isCoordinator();
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Incident  $incident
     * @return mixed
     */
    public function delete(User $user, Incident $incident)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Incident  $incident
     * @return mixed
     */
    public function restore(User $user, Incident $incident)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Incident  $incident
     * @return mixed
     */
    public function forceDelete(User $user, Incident $incident)
    {
        return $user->isAdmin();
    }
}

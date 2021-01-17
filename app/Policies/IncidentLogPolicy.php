<?php

namespace App\Policies;

use App\Models\IncidentLog;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class IncidentLogPolicy extends AbstractPolicy
{
    use HandlesAuthorization;

    protected $uriKey = 'incident-logs';

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
     * @param  \App\Models\IncidentLog  $incidentLog
     * @return mixed
     */
    public function view(User $user, IncidentLog $incidentLog)
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
        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\IncidentLog  $incidentLog
     * @return mixed
     */
    public function update(User $user, IncidentLog $incidentLog)
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\IncidentLog  $incidentLog
     * @return mixed
     */
    public function delete(User $user, IncidentLog $incidentLog)
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\IncidentLog  $incidentLog
     * @return mixed
     */
    public function restore(User $user, IncidentLog $incidentLog)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\IncidentLog  $incidentLog
     * @return mixed
     */
    public function forceDelete(User $user, IncidentLog $incidentLog)
    {
        return false;
    }
}

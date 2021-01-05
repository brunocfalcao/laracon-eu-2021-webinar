<?php

namespace App\Policies;

use App\Models\IncidentLog;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Laravel\Nova\Http\Requests\NovaRequest;

class IncidentLogPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        /*
         * This codebase will guarantee that the incident logs only appear
         * on related resource relationship data, and never as the main
         * resource Incident Log being managed.

        if (resolve(NovaRequest::class)->isResourceIndexRequest() &&
           request()->resource == 'incident-logs' &&
           empty(request()->viaResource)) {
            return false;
        }
        */

        return true;
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
        //
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
        //
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
        //
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
        //
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
        //
    }
}

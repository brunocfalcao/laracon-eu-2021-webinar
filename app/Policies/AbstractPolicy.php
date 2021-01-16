<?php

namespace App\Policies;

use App\Models\User;
use Laravel\Nova\Http\Requests\NovaRequest;
use Illuminate\Auth\Access\HandlesAuthorization;

class AbstractPolicy
{
    use HandlesAuthorization;

    protected $uriKey;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        // Appears on navigation sidebar?
        if (!$user->isAdmin() && empty(request()->resource)) {
            return false;
        };

        /*
         * The incident logs only appear on related resource relationship data
         * and never as the main resource Incident Log being managed.
         */
        if (resolve(NovaRequest::class)->isResourceIndexRequest() &&
           request()->resource == $this->uriKey &&
           empty(request()->viaResource)) {
            return false;
        };

        return true;
    }
}

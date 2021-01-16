<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
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
        // User is admin? Can see everything.
        if ($user->isAdmin()) {
            return true;
        }

        // Hide in sidebar in case the user is not admin.
        if (!$user->isAdmin() && empty(request()->resource)) {
            return false;
        };

        /*
         * The incident logs only appear on related resource relationship data
         * and never as the main resource Incident Log being managed.
         */
        if (resolve(NovaRequest::class)->isResourceIndexRequest() &&
           request()->resource == $this->uriKey &&
           empty(request()->viaResource) &&
           $user->isAdmin()) {
            return false;
        };

        return true;
    }
}

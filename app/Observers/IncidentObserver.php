<?php

namespace App\Observers;

use App\Models\Incident;
use App\Models\IncidentLog;
use App\Models\Status;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class IncidentObserver
{
    /**
     * Handle the Incident "saving" event.
     *
     * @param  \App\Models\Incident  $incident
     * @return void
     */
    public function saving(Incident $incident)
    {
        if ($incident->status_id == null) {
            $incident->status_id = Status::firstWhere('name', 'New')->id;
        }
    }

    /**
     * Handle the Incident "created" event.
     *
     * @param  \App\Models\Incident  $incident
     * @return void
     */
    public function created(Incident $incident)
    {
        IncidentLog::create([
            'incident_id' => $incident->id,
            'status_id' => Status::firstWhere('name', 'New')->id,
            'status_id' => Status::firstWhere('name', 'New')->id,
            'user_id' => Auth::check() ? Auth::id() : null,
            'description' => 'Incident created by '.$incident->requester->name,
            // In case we are simulating an incident lifecycle...
            'created_at' => $incident->created_at,
            'updated_at' => $incident->updated_at
        ]);
    }

    /**
     * Handle the Incident "updated" event.
     *
     * @param  \App\Models\Incident  $incident
     * @return void
     */
    public function updated(Incident $incident)
    {
        // Instance log instance with default attributes.
        $logInstance = new IncidentLog();
        $logInstance->incident_id = $incident->id;
        $logInstance->status_id = $incident->status_id;
        $logInstance->user_id = $incident->user_id;

        // In case we are simulating an incident lifecycle...
        $logInstance->created_at = $incident->updated_at;
        $logInstance->updated_at = $logInstance->created_at;

        /*
         * 2 attributes are dynamic: action_type_id and description.
         * Cases:
         * - Assignment
         * - Reassignment
         * - Closed
         * - Update (without re/assignment our closed)
         */
        if ($incident->isFirstAssigned()) {
            $logInstance->description = 'Incident assigned to ' .
                                        User::firstwhere('id', $incident->user_id)->name;
            $logInstance->save();
        }

        if ($incident->isReassigned()) {
            $logInstance->description = 'Incident reassigned to ' .
                                        User::firstwhere('id', $incident->user_id)->name;
            $logInstance->save();
        }

        if ($incident->isClosed()) {
            $logInstance->description = 'Incident closed';
            $logInstance->save();
        }

        if ($incident->onlyContentUpdated()) {
            $logInstance->description = 'Incident content updated';
            $logInstance->save();
        }
    }

    /**
     * Handle the Incident "deleted" event.
     *
     * @param  \App\Models\Incident  $incident
     * @return void
     */
    public function deleted(Incident $incident)
    {
        //
    }

    /**
     * Handle the Incident "restored" event.
     *
     * @param  \App\Models\Incident  $incident
     * @return void
     */
    public function restored(Incident $incident)
    {
        //
    }

    /**
     * Handle the Incident "force deleted" event.
     *
     * @param  \App\Models\Incident  $incident
     * @return void
     */
    public function forceDeleted(Incident $incident)
    {
        //
    }
}

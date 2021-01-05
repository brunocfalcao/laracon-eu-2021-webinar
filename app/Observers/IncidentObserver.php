<?php

namespace App\Observers;

use App\Models\Incident;
use App\Models\IncidentLog;
use App\Models\User;

class IncidentObserver
{
    /**
     * Handle the Incident "saved" event.
     *
     * @param  \App\Models\Incident  $incident
     * @return void
     */
    public function saved(Incident $incident)
    {
        // Instance log instance with default attributes.
        $logInstance = new IncidentLog();
        $logInstance->incident_id = $incident->id;
        $logInstance->status_id = $incident->status_id;
        $logInstance->user_id = $incident->user_id;

        // In case we are simulating an incident lifecycle...
        $logInstance->created_at = $incident->updated_at;
        $logInstance->updated_at = $logInstance->created_at;

        $logInstance->description = 'Incident created';
        $logInstance->save();

        if ($incident->isFirstAssigned()) {
            $logInstance->description = 'Incident assigned to '.
                                        User::firstwhere('id', $incident->user_id)->name;
            $logInstance->save();

            return;
        }

        if ($incident->isReassigned()) {
            $logInstance->description = 'Incident reassigned to '.
                                        User::firstwhere('id', $incident->user_id)->name;
            $logInstance->save();

            return;
        }

        if ($incident->isClosed()) {
            $logInstance->description = 'Incident closed';
            $logInstance->save();

            return;
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

<?php

namespace App\Observers;

use App\Models\Incident;

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
        //
    }

    /**
     * Handle the Incident "created" event.
     *
     * @param  \App\Models\Incident  $incident
     * @return void
     */
    public function created(Incident $incident)
    {
        //
    }

    /**
     * Handle the Incident "updated" event.
     *
     * @param  \App\Models\Incident  $incident
     * @return void
     */
    public function updated(Incident $incident)
    {
        //
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

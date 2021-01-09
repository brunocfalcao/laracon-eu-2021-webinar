<?php

namespace App\Nova\Dashboards;

use Laravel\Nova\Dashboard;
use Brunocfalcao\IncidentsTotal\IncidentsTotal;

class Insights extends Dashboard
{
    /**
     * Get the cards for the dashboard.
     *
     * @return array
     */
    public function cards()
    {
        //
    }

    /**
     * Get the URI key for the dashboard.
     *
     * @return string
     */
    public static function uriKey()
    {
        return 'insights';
    }
}

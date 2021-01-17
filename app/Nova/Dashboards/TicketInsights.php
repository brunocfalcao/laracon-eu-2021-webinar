<?php

namespace App\Nova\Dashboards;

use App\Nova\Metrics\IncidentsByCategoryMetric;
use App\Nova\Metrics\IncidentsPerDayMetric;
use App\Nova\Metrics\TotalIncidentsMetric;
use Laravel\Nova\Dashboard;

class TicketInsights extends Dashboard
{
    /**
     * Get the displayable name of the dashboard.
     *
     * @return string
     */
    public static function label()
    {
        return 'Ticket Insights';
    }

    /**
     * Get the cards for the dashboard.
     *
     * @return array
     */
    public function cards()
    {
        return [
            new TotalIncidentsMetric(),
            new IncidentsPerDayMetric(),
            new IncidentsByCategoryMetric(),
        ];
    }

    /**
     * Get the URI key for the dashboard.
     *
     * @return string
     */
    public static function uriKey()
    {
        return 'ticket-insights';
    }
}

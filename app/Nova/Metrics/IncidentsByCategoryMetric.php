<?php

namespace App\Nova\Metrics;

use App\Models\Category;
use App\Models\Incident;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\Partition;

class IncidentsByCategoryMetric extends Partition
{
    /**
     * Get the displayable name of the metric.
     *
     * @return string
     */
    public function name()
    {
        return 'Incidents by Category';
    }

    /**
     * Calculate the value of the metric.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return mixed
     */
    public function calculate(NovaRequest $request)
    {
        $labels = Category::pluck('name', 'id');

        return $this->count($request, Incident::class, 'category_id')
                    ->label(function ($value) use ($labels) {
                        return $labels[$value];
                    });
    }

    /**
     * Determine for how many minutes the metric should be cached.
     *
     * @return  \DateTimeInterface|\DateInterval|float|int
     */
    public function cacheFor()
    {
        // return now()->addMinutes(5);
    }

    /**
     * Get the URI key for the metric.
     *
     * @return string
     */
    public function uriKey()
    {
        return 'incidents-by-category-metric';
    }
}

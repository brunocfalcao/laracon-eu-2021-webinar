<?php

namespace App\Nova\Filters;

use App\Models\Status;
use Illuminate\Http\Request;
use Laravel\Nova\Filters\Filter;

class IncidentStatusFilter extends Filter
{
    /**
     * The filter's component.
     *
     * @var string
     */
    public $component = 'select-filter';

    /**
     * Apply the filter to the given query.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  mixed  $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function apply(Request $request, $query, $value)
    {
        return $query->where('status_id', $value);
    }

    /**
     * Get the filter's available options.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function options(Request $request)
    {
        /**
         * The array key is the dropdown label.
         * The array value is the dropdown value.
         *
         * It's the opposite that we normally see on arrays.
         */
        return Status::all()->pluck('id', 'name');
    }
}

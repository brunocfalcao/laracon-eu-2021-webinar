<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\BelongsTo;
use App\Nova\Filters\IncidentStatusFilter;
use App\Nova\Lenses\MostImportantIncidents;
use Laravel\Nova\Http\Requests\NovaRequest;
use App\Nova\Filters\IncidentCategoryFilter;

class Incident extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Incident::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'title';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'title', 'description',
    ];

    /**
     * Build an "index" query for the given resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function indexQuery(NovaRequest $request, $query)
    {
        //throw new \Exception('Inside index query');
        //return $query->where('user_id', $request->user()->id);
    }

    /**
     * Build an "index" query for the given resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function relatableQuert(NovaRequest $request, $query)
    {
        throw new \Exception('Inside relatable query');

        return $query->where('user_id', $request->user()->id);
    }

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make(__('ID'), 'id')->sortable(),

            Text::make('Title', 'title')
                ->rules('required'),

            Textarea::make('Description', 'description'),

            BelongsTo::make('User', 'user', User::class),

            BelongsTo::make('Requester', 'requester', Requester::class)
                     ->searchable()
                     ->showCreateRelationButton(),

            BelongsTo::make('Severity', 'severity', Severity::class)
                     ->hideFromIndex(),

            BelongsTo::make('Priority', 'priority', Priority::class)
                     ->hideFromIndex(),

            BelongsTo::make('Status', 'status', Status::class),

            BelongsTo::make('Category', 'category', Category::class),

            HasMany::make('Log', 'logs', IncidentLog::class),

        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [
            new IncidentStatusFilter(),
            new IncidentCategoryFilter(),
        ];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [
            new MostImportantIncidents()
        ];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}

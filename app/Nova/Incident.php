<?php

namespace App\Nova;

use App\Nova\Filters\IncidentCategoryFilter;
use App\Nova\Filters\IncidentStatusFilter;
use App\Nova\Lenses\MostImportantIncidents;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;

class Incident extends AbstractResource
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

            BelongsToMany::make('Tags', 'tags', Tag::class),

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
            new MostImportantIncidents(),
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

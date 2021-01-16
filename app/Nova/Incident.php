<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use App\Nova\Lenses\MyIncidents;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\BelongsTo;
use App\Models\Status as StatusModel;
use Laravel\Nova\Fields\BelongsToMany;
use App\Nova\Filters\IncidentStatusFilter;
use Laravel\Nova\Http\Requests\NovaRequest;
use App\Nova\Filters\IncidentCategoryFilter;
use App\Nova\Actions\AssignIncidentToOperatorAction;
use Brunocfalcao\MyTotalIncidentsCard\MyTotalIncidentsCard;

class Incident extends AbstractResource
{
    /**
     * Build an "index" query for the given resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function indexQuery(NovaRequest $request, $query)
    {
        /**
         * Shows the incidents assigned to the own user if he is not
         * admin.
         */
        if (!$request->user()->isAdmin()) {
            return $query->where('user_id', $request->user()->id)
                         ->orWhere('status_id', StatusModel::firstWhere('name', 'New')
                                                      ->id);
        }
    }

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
        return [
            new MyTotalIncidentsCard()
        ];
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
            new MyIncidents(),
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
        return [
            new AssignIncidentToOperatorAction()
        ];
    }
}

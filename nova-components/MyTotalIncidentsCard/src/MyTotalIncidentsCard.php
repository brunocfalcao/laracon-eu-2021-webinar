<?php

namespace Brunocfalcao\MyTotalIncidentsCard;

use Laravel\Nova\Card;
use App\Models\Incident;

class MyTotalIncidentsCard extends Card
{

    /**
     * Create a new element.
     *
     * @param  string|null  $component
     * @return void
     */
    public function __construct($component = null)
    {
        $this->withMeta(['total' => Incident::assignedToMyself()->count()]);

        parent::__construct($component);
    }

    /**
     * The width of the card (1/3, 1/2, or full).
     *
     * @var string
     */
    public $width = '1/3';

    /**
     * Get the component name for the element.
     *
     * @return string
     */
    public function component()
    {
        return 'my-total-incidents-card';
    }
}

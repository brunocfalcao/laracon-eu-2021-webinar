<?php

namespace Brunocfalcao\FaText;

use Laravel\Nova\Fields\Field;

class FaText extends Field
{
    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'fa-text';

    public function icon($class = 'fab fa-laravel')
    {
        $this->withMeta(['icon_class' => $class]);
        return $this;
    }
}

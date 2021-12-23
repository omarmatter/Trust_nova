<?php

namespace Acm\RepeatRow;

use Laravel\Nova\Fields\Field;

class RepeatRow extends Field
{
    /**
     * The field's component.
     *
     * @var array[]
     */

    public function hues(array $fields)
    {
        return $this->withMeta(['hues' => $fields]);
    }
    public function options(array $fields)
    {
        return $this->withMeta(['options' => $fields]);
    }
    public $component = 'repeat-row';
}

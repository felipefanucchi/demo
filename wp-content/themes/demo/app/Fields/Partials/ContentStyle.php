<?php

namespace App\Fields\Partials;

use Log1x\AcfComposer\Partial;
use StoutLogic\AcfBuilder\FieldsBuilder;

class ContentStyle extends Partial
{
    /**
     * The partial field group.
     *
     * @return \StoutLogic\AcfBuilder\FieldsBuilder
     */
    public function fields()
    {
        $fields = new FieldsBuilder('rich_text');

        $fields
            ->addButtonGroup('Content Style', [
                'name' => 'style',
                'default_value' => 'dark',
                'choices' => [
                    'dark' => 'Dark',
                    'light' => 'Light',
                ]
            ]);

        return $fields;
    }
}

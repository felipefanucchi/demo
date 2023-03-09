<?php

namespace App\Blocks;

use App\Fields\Partials\ContentStyle;
use Log1x\AcfComposer\Block;
use StoutLogic\AcfBuilder\FieldsBuilder;


use function Roots\bundle;

class Slider extends Block
{
    /**
     * The block name.
     *
     * @var string
     */
    public $name = 'Slider';

    /**
     * The block description.
     *
     * @var string
     */
    public $description = 'A simple Slider block.';

    /**
     * The block category.
     *
     * @var string
     */
    public $category = 'custom-layout';

    /**
     * The block icon.
     *
     * @var string|array
     */
    public $icon = 'slides';

    /**
     * The block keywords.
     *
     * @var array
     */
    public $keywords = ['slide', 'carousel', 'page header'];

    /**
     * The default block mode.
     *
     * @var string
     */
    public $mode = 'preview';

    /**
     * The supported block features.
     *
     * @var array
     */
    public $supports = [
        'align' => true,
        'align_text' => true,
        'align_content' => true,
        'full_height' => true,
        'anchor' => true,
        'mode' => true,
        'multiple' => true,
        'jsx' => true,
    ];

    /**
     * The block preview example data.
     *
     * @var array
     */
    public $example = [
        'items' => [
            ['background' => 'images/slider/example.jpeg'],
            ['background' => 'images/slider/example.jpeg'],
            ['background' => 'images/slider/example.jpeg'],
        ],
    ];

    /**
     * Data to be passed to the block before rendering.
     *
     * @return array
     */
    public function with()
    {
        return [
            'items' => $this->items(),
        ];
    }

    /**
     * The block field group.
     *
     * @return array
     */
    public function fields()
    {
        $slider = new FieldsBuilder('slider');

        $slider
            ->addRepeater('items')
                ->addImage('background', [
                    'instructions' => 'Recommended size: <code>1920x1080</code>',
                    'required' => true
                ])
                ->addFields($this->get(ContentStyle::class))
                ->addWysiwyg('content')
            ->endRepeater();

        return $slider->build();
    }

    /**
     * Return the items field.
     *
     * @return array
     */
    public function items()
    {
        return get_field('items') ?: $this->example['items'];
    }

    /**
     * Assets to be enqueued when rendering the block.
     *
     * @return void
     */
    public function enqueue()
    {
        bundle('swiper')->enqueue()->enqueueCss();
        bundle('slider')->enqueue()->enqueueCss('all', ['swiper']);
    }
}

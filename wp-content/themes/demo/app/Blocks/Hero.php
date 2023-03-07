<?php

namespace App\Blocks;

use Log1x\AcfComposer\Block;
use StoutLogic\AcfBuilder\FieldsBuilder;

use function Roots\asset;
use function Roots\bundle;

class Hero extends Block
{
    /**
     * The block name.
     *
     * @var string
     */
    public $name = 'Hero';

    /**
     * The block description.
     *
     * @var string
     */
    public $description = 'A simple Hero block.';

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
    public $icon = 'editor-ul';

    /**
     * The block keywords.
     *
     * @var array
     */
    public $keywords = [];

    /**
     * The block post type allow list.
     *
     * @var array
     */
    public $post_types = [];

    /**
     * The parent block type allow list.
     *
     * @var array
     */
    public $parent = [];

    /**
     * The default block mode.
     *
     * @var string
     */
    public $mode = 'preview';

    /**
     * The default block alignment.
     *
     * @var string
     */
    public $align = '';

    /**
     * The default block text alignment.
     *
     * @var string
     */
    public $align_text = '';

    /**
     * The default block content alignment.
     *
     * @var string
     */
    public $align_content = '';

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
        'mode' => true,
        'multiple' => true,
        'jsx' => true,
    ];

    /**
     * The block styles.
     *
     * @var array
     */
    public $styles = [
        // [
        //     'name' => 'light',
        //     'label' => 'Light',
        //     'isDefault' => true,
        // ],
        // [
        //     'name' => 'dark',
        //     'label' => 'Dark',
        // ]
    ];

    /**
     * The block preview example data.
     *
     * @var array
     */
    public $example = [
        'background' => 'images/hero/example.jpeg'
    ];

    /**
     * Data to be passed to the block before rendering.
     *
     * @return array
     */
    public function with()
    {
        return [
            'background' =>
                get_field('background') ?: asset($this->example['background']),
        ];
    }

    /**
     * The block field group.
     *
     * @return array
     */
    public function fields()
    {
        $hero = new FieldsBuilder('hero');

        $hero
            ->addImage('background', [
                'instructions' => 'Recommended size: <code>1920x1080</code>',
                'required' => true,
            ]);

        return $hero->build();
    }

    /**
     * Assets to be enqueued when rendering the block.
     *
     * @return void
     */
    public function enqueue()
    {
        bundle('hero')->enqueue();
    }
}

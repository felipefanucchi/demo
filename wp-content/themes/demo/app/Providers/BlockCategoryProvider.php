<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class BlockCategoryProvider extends ServiceProvider
{

    public $custom_categories = array(
        array(
            'slug'  => 'custom-layout',
            'title' => 'Layout',
            'icon' => 'wordpress'
        )
    );

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        add_filter( 'block_categories_all' , array( $this, 'register_categories' ));
    }

    /**
     * Gather all current categories and push new ones based on $custom_categories variable
     *
     * @param array $categories
     * @return array $categories
     */
    public function register_categories($categories) {
        foreach($this->custom_categories as $category) {
            $categories[] = $category;
        }

        return $categories;
    }
}

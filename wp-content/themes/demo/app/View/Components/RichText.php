<?php

namespace App\View\Components;

use Illuminate\View\Component;

class RichText extends Component
{

    public $content;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(String $content)
    {
        $this->content = $content;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.rich-text');
    }
}

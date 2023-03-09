<?php

namespace App\View\Components;

use Illuminate\View\Component;

use function Termwind\style;

class RichText extends Component
{

    public $content;

    public $style;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(String $content, String $style)
    {
        $this->content = $content;
        $this->style = $this->convertToTwClasses($style);
    }

    /**
     * Get the current applied style and convert to tailwind classes
     */
    private function convertToTwClasses(String $style)
    {
        if ($style === 'light') {
            $style = 'prose-invert';
        }

        if ($style == 'dark') {
            $style = ''; // .prose from Tw already is dark
        }

        return $style;
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

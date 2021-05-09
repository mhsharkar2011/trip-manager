<?php

namespace App\View\Components\Devpanel;

use Illuminate\View\Component;

class Iframe extends Component
{
    public $src;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($src)
    {
        $this->src = $src;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('devpanel.components.devtools.show-in-iframe');
    }
}

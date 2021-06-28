<?php

namespace App\View\Components;

use App\Bulletin;
use Illuminate\View\Component;

class Post extends Component
{
    public $bulletin;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Bulletin $bulletin)
    {
        $this->bulletin = $bulletin;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.post');
    }
}

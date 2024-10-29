<?php

namespace App\View\Components\Frontend;

use Illuminate\View\Component;

class SectionTitle extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    private $title;
    private $description;

    public function __construct($title, $description)
    {
        $this->title = $title;
        $this->description = $description;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.frontend.section-title', [
            'title' => $this->title,
            'description' => $this->description
        ]);
    }
}

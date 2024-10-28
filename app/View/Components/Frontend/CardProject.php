<?php

namespace App\View\Components\Frontend;

use App\Models\Project;
use Illuminate\View\Component;

class CardProject extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    private $id;
    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $project = Project::findOrFail($this->id);
        return view('components.frontend.card-project', [
            'project' => $project
        ]);
    }
}

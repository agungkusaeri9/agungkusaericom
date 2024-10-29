<?php

namespace App\View\Components\Frontend;

use App\Models\Project;
use Illuminate\View\Component;

class LatestProject extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $latest_projects = Project::publish()->with('category')->latest()->limit(4)->get();
        return view('components.frontend.latest-project', [
            'latest_projects' => $latest_projects
        ]);
    }
}

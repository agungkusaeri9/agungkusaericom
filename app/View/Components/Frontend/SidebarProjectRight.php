<?php

namespace App\View\Components\Frontend;

use App\Models\ProjectCategory;
use App\Models\ProjectTag;
use App\Models\Setting;
use App\Models\Socmed;
use Illuminate\View\Component;

class SidebarProjectRight extends Component
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
        $project_categories = ProjectCategory::withCount(['projects' => function($q){
            $q->where('is_publish',1);
        }])->orderBy('name','ASC')->get();
        $project_categories_portfolio = ProjectCategory::withCount(['projects' => function($q){
            $q->where('is_publish',1)->where('is_portfolio',1);
        }])->orderBy('name','ASC')->get();
        $project_tags = ProjectTag::orderBy('name','ASC')->get();
        $setting = Setting::first();
        $socmeds = Socmed::orderBy('name','ASC')->get();
        return view('components.frontend.sidebar-project-right',compact('project_categories','project_tags','setting','socmeds','project_categories_portfolio'));
    }
}

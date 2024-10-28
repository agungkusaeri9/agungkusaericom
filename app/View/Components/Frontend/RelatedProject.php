<?php

namespace App\View\Components\Frontend;

use App\Models\Project;
use Illuminate\View\Component;

class RelatedProject extends Component
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
        $project = Project::find($this->id);
        $tags = $project->tags()->pluck('name');
        if (count($tags)) {
            $related = Project::whereHas('tags', function ($tag) use ($tags) {
                $tag->whereIn('name', $tags);
            })->latest()->limit(3)->get();
        } else {
            $related = Project::latest()->limit(3)->get();
        }
        return view(
            'components.frontend.related-project',
            [
                'related_projects' => $related
            ]
        );
    }
}

<?php

namespace App\View\Components\Frontend;

use App\Models\Post;
use App\Models\PostCategory;
use Illuminate\View\Component;

class LatestPost extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct() {}

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $latest_posts  = Post::publish()->latest()->limit(6)->get();
        return view('components.frontend.latest-post', [
            'latest_posts' => $latest_posts
        ]);
    }
}

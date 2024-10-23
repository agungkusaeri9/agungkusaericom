<?php

namespace App\View\Components\Frontend;

use App\Models\Post;
use App\Models\PostCategory;
use App\Models\PostTag;
use App\Models\Setting;
use App\Models\Socmed;
use Illuminate\View\Component;

class SidebarRightPost extends Component
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
        $post_categories = PostCategory::withCount('posts')->orderBy('name', 'ASC')->get();
        $post_tags = PostTag::withCount('posts')->orderBy('name', 'ASC')->get();
        $setting = Setting::first();
        $socmeds = Socmed::orderBy('name', 'ASC')->get();
        $popular_posts = Post::orderBy('visitor', 'DESC')->limit(5)->get();
        return view('components.frontend.sidebar-right-post', compact('post_categories', 'post_tags', 'setting', 'socmeds', 'popular_posts'));
    }
}

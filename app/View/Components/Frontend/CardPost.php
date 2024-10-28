<?php

namespace App\View\Components\Frontend;

use App\Models\PostCategory;
use Illuminate\View\Component;

class CardPost extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $title, $image, $categoryid, $slug, $metadescription;
    public function __construct($title, $image, $slug, $categoryid, $metadescription = null)
    {
        $this->title = $title;
        $this->image = $image;
        $this->slug = $slug;
        $this->categoryid = $categoryid;
        $this->metadescription = $metadescription;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $category = PostCategory::find($this->categoryid);
        return view('components.frontend.card-post', [
            'title' => $this->title,
            'image' => $this->image,
            'metadescription' => $this->metadescription,
            'slug' => $this->slug,
            'category' => $category,
        ]);
    }
}

<?php

namespace App\View\Components\Frontend;

use App\Models\Setting;
use Illuminate\View\Component;

class SidebarAuthor extends Component
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
        $setting = Setting::first();
        return view('components.frontend.sidebar-author', [
            'setting' => $setting
        ]);
    }
}

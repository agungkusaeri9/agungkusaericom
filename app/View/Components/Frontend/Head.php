<?php

namespace App\View\Components\Frontend;

use App\Models\Setting;
use Illuminate\View\Component;

class Head extends Component
{
    public $title;
    public function __construct($title = '-')
    {
        $this->title = $title;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $setting = Setting::first();
        return view('components.frontend.head',[
            'title' => $this->title,
            'setting' => $setting
        ]);
    }
}

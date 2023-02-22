<?php

namespace App\View\Components\Frontend;

use App\Models\Setting;
use Illuminate\View\Component;

class IconWa extends Component
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
        $link = 'https://wa.me/'.$setting->whatsapp_number;
        return view('components.frontend.icon-wa',[
            'link' => $link
        ]);
    }
}

<?php

namespace App\View\Components\Frontend;

use App\Models\ServiceType;
use App\Models\Setting;
use Illuminate\View\Component;

class Navbar extends Component
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
        $services = ServiceType::orderBy('name','ASC')->get();
        return view('components.frontend.navbar',[
            'setting' => Setting::first(),
            'services' => $services
        ]);
    }
}

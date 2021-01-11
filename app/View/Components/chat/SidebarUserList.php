<?php

namespace App\View\Components\chat;

use Illuminate\View\Component;

class SidebarUserList extends Component
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
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.chat.sidebar-user-list');
    }
}

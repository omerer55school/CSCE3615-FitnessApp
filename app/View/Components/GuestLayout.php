<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

/**
 * Class GuestLayout
 *
 * Represents the layout component for guest users.
 */
class GuestLayout extends Component
{
    /**
     * Get the view or contents that represents the component.
     *
     * @return View The view instance representing the guest layout.
     */
    public function render(): View
    {
        // Return the view for the guest layout
        return view('layouts.guest');
    }
}

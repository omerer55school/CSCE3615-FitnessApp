<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

/**
 * Class AppLayout
 *
 * Represents the layout component for the application.
 */
class AppLayout extends Component
{
    /**
     * Get the view or contents that represents the component.
     *
     * @return View The view instance representing the layout.
     */
    public function render(): View
    {
        // Return the view for the application's layout
        return view('layouts.app');
    }
}

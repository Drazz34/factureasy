<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class EditButton extends Component
{

    public $route_name;
    public $item_id;
    
    /**
     * Create a new component instance.
     */
    public function __construct($routeName, $itemId)
    {
        $this->route_name = $routeName;
        $this->item_id = $itemId;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.edit-button');
    }
}

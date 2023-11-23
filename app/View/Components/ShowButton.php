<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ShowButton extends Component
{
    public $client_id;

    public function __construct($clientId)
    {
        $this->client_id = $clientId;
    }

    public function render()
    {
        return view('components.show-button');
    }
}

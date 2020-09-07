<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Alert extends Component
{
    /**
     * alert type.
     *
     * @var string
     */
    public $type = 'danger';
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(String $type='danger')
    {
        $this->type = $type;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.alert');
    }
}

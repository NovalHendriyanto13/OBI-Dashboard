<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Form extends Component
{
    /**
     * Id
     *
     * @var string
     */
    public $id;

    /**
     * action.
     *
     * @var String
     */
    public $action;

    /**
     * class.
     *
     * @var string
     */
    public $class;

    /**
     * method.
     *
     * @var string
     */
    public $method;

    /**
     * action buttons.
     *
     * @var array
     */
    public $actionButtons;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($id, $class, $action, $method='post', $actionButtons=[])
    {
        $this->id = $id;
        $this->class = $class;
        $this->action = $action;
        $this->method = $method;
        $this->actionButtons = $actionButtons;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.form');
    }
}

<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ActionButton extends Component
{
    /**
     *
     * @var Array
     */
    public $setting;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($setting=[])
    {
        if (count($setting) <= 0)
            $setting = $this->default();
        
        $this->setting = $setting;
    }

    protected function default() {
        return [
            [
                'icon'=>'x-circle',
                'class'=>'btn-white',
                'title'=>'Cancel',
                'url'=>url()->previous(),
                'type'=>'link',
            ],
            [
                'icon'=>'check-circle',
                'class'=>'btn-primary',
                'title'=>'Submit',
                'type'=>'button'
            ],
        ];
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.action-button',[
            'data'=>$this->setting
        ]);
    }
}

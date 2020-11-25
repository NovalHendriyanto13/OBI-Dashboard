<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Table extends Component
{
    /**
     * Setting
     *
     * @var array
     */
    public $setting;

    private $exception = ['created_at','created_by','modified_at','modified_by'];
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($setting=[])
    {
        if(!array_key_exists('bulks', $setting))
            $setting['bulks'] = [];
        
        if(!array_key_exists('searchable', $setting))
            $setting['searchable'] = false;

        if(!array_key_exists('source', $setting))
            $setting['source'] = \Request::path().'/data-list';

        $this->setting = $setting;
    }

    private function getSetting() {
        if (count($this->setting) > 0) {
            return $this->setting;
        }
        
        $this->setting['columns'] = $setting;
        return $this->setting;
    }

    private function setFilters() {
        if (!$this->setting['searchable'])
            return [];

        $filters = [];
        foreach($this->setting['columns'] as $f) {
            if (isset($f['search'])) {
                $filters[] = [
                    'name'=>$f['name'],
                    'type'=>$f['search']['type']
                ];
            }
        }
        return $filters;
    }

    private function setColumns() {
        $columns = [];
        if (isset($this->setting['bulks']) && count($this->setting['bulks']) > 0) {
            $columns[] = [
                'name'=>'bulks',
                'data'=>'bulks',
                'orderable'=>false,
                'searchable'=>false
            ];
        }
        foreach($this->setting['columns'] as $c) {
            if ($c['visible'] == true) {
                $columns[] = [
                    'name'=>$c['name'],
                    'data'=>$c['name']
                ];
            }
        }
        if (isset($this->setting['grid_actions']) && count($this->setting['grid_actions']) > 0) {
            $columns[] = [
                'name'=>'grid_actions',
                'data'=>'grid_actions',
                'orderable'=>false,
                'searchable'=>false
            ];
        }
        
        return $columns;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        $setting = $this->getSetting();
        $filters = $this->setFilters();
        $columns = $this->setColumns();
        
        return view('components.table',[
            'setting'=>$setting,
            'filters'=>$filters,
            'columns'=>json_encode($columns),
        ]);
    }
}

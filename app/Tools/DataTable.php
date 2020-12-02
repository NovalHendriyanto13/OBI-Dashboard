<?php
namespace App\Tools;
use Yajra\Datatables\Datatables;

class DataTable extends Datatables{

    private static $_model;
    private static $_columns;

    public static function build($model, $setting) {
        $dataTables = Datatables::of($model);
        $raws = [];
        
        foreach($setting['table']['columns'] as $c) {
            $field = $c['name'];
            $relation = explode('.', $field);
            
            if (count($relation) > 1) {
                list($property, $value) = $relation;
                
                $dataTables = $dataTables->editColumn($field, function($model) use ($property, $value){
                    return ($model->$property)[$value];
                });
            }
            if (isset($c['transform'])) {
                $transform = $c['transform'];
                $dataTables = $dataTables->editColumn($field, function($model) use ($transform, $field){
                    if (is_array($transform))
                        return $transform[$model[$field]];

                    if (is_callable($transform)) {
                        return $transform($model[$field]);
                    }
                });
            }
        }
        
		if(isset($setting['table']['grid_actions'])) {
            $actions = $setting['table']['grid_actions'];
            if (count($actions) > 0) 
                $raws[] = 'grid_actions';
            
            $dataTables = $dataTables->addColumn('grid_actions', function($model) use ($actions) {
                $str = '';
				foreach($actions as $action) {
					$icon = '';
					if(isset($action['icon']) && $action['icon'] != '')
						$icon = '<i data-feather="'.$action['icon'].'" class="wd-10 mg-r-5"></i>';
						
					$str .= '<a href="'.$action['url']."/".$model->id.'" class="btn '.$action['class'].'">'
						.$icon
						.$action['title'].'</a> &nbsp';
                }
                return $str;
			});

        }
        if(isset($setting['table']['bulks'])) {
            $bulks = $setting['table']['bulks'];
            if (count($bulks) > 0) 
                $raws[] = 'bulks';

            $dataTables = $dataTables->addColumn('bulks', function($model) use ($bulks) {
                foreach($bulks as $bulk) {
                    return '<input type="checkbox" name="check[]" id="table-check" value="'. $model->id .'" class="table-check"/>';
                }
            });
            
        }
        
        return $dataTables->rawColumns($raws);
    }
}
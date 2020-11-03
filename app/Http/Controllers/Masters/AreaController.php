<?php
namespace App\Http\Controllers\Masters;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use App\Models\Area;
use App\Form\AreaForm;

class AreaController extends BaseController {
	protected $_baseUrl = 'area';
	protected $_title = 'Area';
	protected $_model = Area::class;

	protected function indexData() {
		return [
			'table'=>[
				'columns'=>[
					[
						'name'=>'id',
						'title'=>'ID',
						'visible'=>false,
					],
					[
						'name'=>'area_code',
						'title'=>'Code',
						'visible'=>true,
					],
					[
						'name'=>'name',
						'title'=>'Name',
						'visible'=>true,
					],
					// [
					// 	'name'=>'address',
					// 	'title'=>'Address',
					// 	'visible'=>true,
					// ],
					[
						'name'=>'type',
						'title'=>'Type',
						'visible'=>true,
						'transform'=>['Not Pool', 'Pool']
					],
					[
						'name'=>'status',
						'title'=>'Status',
						'visible'=>true,
						'transform'=>['Inactive', 'Active'],
					],
				],
				'bulks'=>[
					'active:0'=>'Deactive',
					'active:1'=>'Active'
				],
				'grid_actions'=>[
					[
						'icon'=>'edit',
						'class'=>'btn-primary',
						'title'=>'Update',
						'url'=>url($this->_baseUrl.'/update')
					],
				],
			],
			'action_buttons'=>[
				[
					'icon'=>'plus-circle',
					'class'=>'btn-primary',
					'title'=>'Add New',
					'url'=>url($this->_baseUrl.'/create'),
					'type'=>'link',
				],
			],
		];
	}

	protected function setForm() {
		return AreaForm::class;
	}

	protected function bulkActions(Request $request) {
		$req = $request->all();
		$data = json_decode($req['data']);

		list($action, $value) = explode(':',$req['action']);
		switch($action) {
			case 'active':
				foreach($data as $id) {
					$update = $this->_model::where('id',$id)->update(['status'=>$value]);
				}
			break;
		}
	}
}
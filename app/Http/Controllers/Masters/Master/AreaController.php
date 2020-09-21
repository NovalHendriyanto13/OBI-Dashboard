<?php
namespace App\Http\Controllers\Masters\Master;

use App\Http\Controllers\BaseController;
use App\Models\Area;

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
					[
						'name'=>'address',
						'title'=>'Address',
						'visible'=>true,
					],
					[
						'name'=>'status',
						'title'=>'Status',
						'visible'=>true,
					],
					// [
					// 	'name'=>'action',
					// 	'title'=>'Action',
					// 	'visible'=>true,
					// ],
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
		return MenuForm::class;
	}
}
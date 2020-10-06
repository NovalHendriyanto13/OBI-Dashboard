<?php
namespace App\Http\Controllers\Masters;

use App\Http\Controllers\BaseController;
use App\Models\Unit;
use App\Form\UnitForm;

class UnitController extends BaseController {
	protected $_baseUrl = 'unit';
	protected $_title = 'Unit';
	protected $_model = Unit::class;

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
						'name'=>'police_number',
						'title'=>'Police Number',
						'visible'=>true,
					],
					[
						'name'=>'brand.name',
						'title'=>'Brand',
						'visible'=>true,
					],
					[
						'name'=>'consignor.name',
						'title'=>'Consignor',
						'visible'=>true,
					],
					[
						'name'=>'status',
						'title'=>'Status',
						'visible'=>true,
						'transform'=>['Disable', 'Ready','Sold','Wanpres'],
					],
				],
				'bulks'=>[
					[
						'icon'=>'edit',
						'class'=>'button_primary',
						'title'=>'Active',
						'url'=>url($this->_baseUrl.'/active')
					],
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
		return UnitForm::class;
	}
}
<?php
namespace App\Http\Controllers\Masters;

use App\Http\Controllers\BaseController;
use App\Models\Consignor;
use App\Form\ConsignorForm;

class ConsignorController extends BaseController {
	protected $_baseUrl = 'Consignor';
	protected $_title = 'Consignor';
	protected $_model = Consignor::class;

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
						'name'=>'code',
						'title'=>'Consignor Code',
						'visible'=>true,
					],
					[
						'name'=>'name',
						'title'=>'Consignor',
						'visible'=>true,
					],
					[
						'name'=>'email',
						'title'=>'Email',
						'visible'=>true,
					],
					[
						'name'=>'pic',
						'title'=>'PIC',
						'visible'=>true,
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
		return ConsignorForm::class;
	}
}
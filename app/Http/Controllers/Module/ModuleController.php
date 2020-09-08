<?php
namespace App\Http\Controllers\Module;

use App\Http\Controllers\BaseController;
use App\Models\Module;
use App\Form\ModuleForm;
use Illuminate\Http\Request;

class ModuleController extends BaseController {
	protected $_baseUrl = 'module';
	protected $_title = 'Module';
	protected $_model = Module::class;

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
						'name'=>'initial',
						'title'=>'Initial',
						'visible'=>true,
					],
					[
						'name'=>'name',
						'title'=>'Name',
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
		return ModuleForm::class;
	}
}
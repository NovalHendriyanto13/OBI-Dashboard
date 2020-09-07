<?php
namespace App\Http\Controllers\Users;

use App\Http\Controllers\BaseController;
use App\Models\User;
use App\Form\UserForm;
use Illuminate\Http\Request;

class UserController extends BaseController {
	protected $_baseUrl = 'user';
	protected $_title = 'User';
	protected $_model = User::class;

	protected function indexSetting() {
		return [
			'table'=>[
				'columns'=>[
					[
						'name'=>'id',
						'title'=>'ID',
						'visible'=>false,
					],
					[
						'name'=>'name',
						'title'=>'Name',
						'visible'=>true,
					],
					[
						'name'=>'username',
						'title'=>'Username',
						'visible'=>true,
					],
					[
						'name'=>'email',
						'title'=>'Email',
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
		return UserForm::class;
	}
}
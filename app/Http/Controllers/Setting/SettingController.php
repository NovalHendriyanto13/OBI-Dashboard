<?php
namespace App\Http\Controllers\Setting;

use App\Http\Controllers\BaseController;

class SettingController extends BaseController {
	protected $_baseUrl;
	protected $_baseView = 'setting';
	protected $_title = 'Setting';

	public function clear() {
		$data = [
			'action_buttons'=>[
				[
					'icon'=>'trash',
					'class'=>'btn-primary btn-clear',
					'title'=>'Clear All',
					'type'=>'button',
				],
			],
		];
		return view($this->_baseView.'.clear')->with($data);
	}
}
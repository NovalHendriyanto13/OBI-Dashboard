<?php
namespace App\Form;

use Lib\Form;
use App\View\Components\InputText;

class UserForm extends Form {
	
	protected function initialize($entity=null, array $options) {
		$name = new InputText([
			'name'=>'name',
			'class'=>'tes',
			'type'=>'text',
		]);
		$this->addCollection($name);

		$username = new InputText([
			'name'=>'username',
			'class'=>'username',
			'type'=>'text'
		]);
		$this->addCollection($username);

		$email = new InputText([
			'name'=>'email',
			'type'=>'email',
		]);
		$this->addCollection($email);

		$password = new InputText([
			'name'=>'password',
			'type'=>'password'
		]);
		$this->addCollection($password, 'test');
		
		parent::initialize($entity, $options);
	}
}
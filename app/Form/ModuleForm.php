<?php
namespace App\Form;

use Lib\Form;
use App\View\Components\InputText;
use App\View\Components\InputSelect;

class ModuleForm extends Form {
	
	protected function initialize($entity=null, array $options) {
		$name = new InputText([
			'name'=>'name',
			'class'=>'tes',
			'type'=>'text',
			'required'=>true,
		]);
		$this->addCollection($name);

		$initial = new InputText([
			'name'=>'initial',
			'class'=>'Initial',
			'type'=>'text',
			'required'=>true,
		]);
		$this->addCollection($initial);

		parent::initialize($entity, $options);
	}
}
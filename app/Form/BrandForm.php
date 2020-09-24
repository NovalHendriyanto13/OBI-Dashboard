<?php
namespace App\Form;

use Lib\Form;
use App\View\Components\InputText;
use App\View\Components\InputSelect;
use App\Models\Brand;

class BrandForm extends Form {
	
	protected function initialize($entity=null, array $options) {
		$mode = '';
		if (isset($options['mode']) && $options['mode'] == 'edit')
			$mode = 'edit';

		$parent = new InputSelect([
			'label'=>'Brand',
			'name'=>'parent_id',
			'class'=>'parent-Brand',
			'allowEmpty'=>true,
			'options'=>Brand::select('id','name')
				->whereNull('parent_id')
				->get(),
		]);
		$this->addCollection($parent);

		$name = new InputText([
			'name'=>'name',
			'class'=>'tes',
			'type'=>'text',
			'required'=>true,
		]);
		$this->addCollection($name);

		parent::initialize($entity, $options);
	}
}
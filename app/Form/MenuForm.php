<?php
namespace App\Form;

use Lib\Form;
use App\View\Components\InputText;
use App\View\Components\InputSelect;
use App\Models\Menu;
use App\Models\Module;

class MenuForm extends Form {
	
	protected function initialize($entity=null, array $options) {
		$mode = '';
		if (isset($options['mode']) && $options['mode'] == 'edit')
			$mode = 'edit';

		$name = new InputText([
			'name'=>'name',
			'class'=>'tes',
			'type'=>'text',
			'required'=>true,
		]);
		$this->addCollection($name);

		$parent = new InputSelect([
			'label'=>'Parent Menu',
			'name'=>'parent_id',
			'class'=>'parent-menu',
			'allowEmpty'=>true,
			'options'=>Menu::select('id','name')
				->whereNull('parent_id')
				->get(),
		]);
		$this->addCollection($parent);

		$module = new InputSelect([
			'name'=>'module_id',
			// 'required'=>true,
			'allowEmpty'=>true,
			'options'=>Module::select('id','name')
				->where('action','index')
				->orderBy('name')
				->get()
		]);
		$this->addCollection($module);

		$action = new InputText([
			'name'=>'action',
			'type'=>'text',
			'value'=>'index',
			'readonly'=>true,
			// 'required'=>true,
		]);
		$this->addCollection($action);
		
		$icon = new InputText([
			'name'=>'icon',
			'type'=>'text',
			'label'=>'Icon Class'
		]);
		$this->addCollection($icon);

		$menuGrup = new InputText([
			'name'=>'menu_group',
			'type'=>'text',
			// 'label'=>'Icon Class'
		]);
		$this->addCollection($menuGrup);

		$sort = new InputText([
			'name'=>'sort_number',
			'type'=>'number',
			// 'label'=>'Icon Class'
		]);
		$this->addCollection($sort);

		$status = new InputSelect([
			'label'=>'Visible',
			'name'=>'status',
			'required'=>true,
			'options'=>[
				'No',
				'Yes'
			]
		]);
		$this->addCollection($status);
		parent::initialize($entity, $options);
	}
}
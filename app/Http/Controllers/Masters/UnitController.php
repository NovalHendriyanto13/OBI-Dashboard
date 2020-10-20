<?php
namespace App\Http\Controllers\Masters;

use App\Http\Controllers\BaseController;
use App\Models\Unit;
use App\Models\Gallery;
use App\Form\UnitForm;
use Illuminate\Http\Request;

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

	public function createAction(Request $request) {

	}

	public function update($id) {
		$model = $this->_model::find($id);
		$form = $this->setForm();

		$data = [
			'id'=>$id,
			'form'=>new $form($model, ['mode'=>'edit']),
		];
		
		return view('masters.unit.update')->with($data);

	}
	public function updateAction(Request $request, $id) {
		$data = $request->all();
		dd($data);
	}

	
}
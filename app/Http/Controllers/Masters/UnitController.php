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
					0=>'Deactive',
					1=>'Active'
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
		$this->transactionBegin();
		try {
			$dataUnit = [
				"unit_code" => $data['unit_code'],
				"police_number" => $data['police_number'],
				"brand_id" => $data['brand_id'],
				"consignor_id" => $data['consignor_id'],
				"unit_type_id" => $data['unit_type_id'],
				"area_id" => $data['area_id'],
				"year" => $data['year'],
				"transmission" => $data['transmission'],
				"kilometers" => $data['kilometers'],
				"color" => $data['color'],
				"frame_number" => $data['frame_number'],
				"machine_number" => $data['machine_number'],
				"cylinder" => $data['cylinder'],
				"status" => $data['status'],
				"internal_info" => $data['internal_info'],
				"information" => $data['information'],
				"comment" => $data['comment'],
				"bpkb" => $data['bpkb'],
				"bpkb_name" => $data['bpkb_name'],
				"invoice" => $data['invoice'],
				"receipt" => $data['receipt'],
				"stnk_date" => $data['stnk_date'],
				"tax_date" => $data['tax_date'],
				"machine_grade" => $data['machine_grade'],
				"interior_grade" => $data['interior_grade'],
				"exterior_grade" => $data['exterior_grade'],
				"limit_price" => $data['limit_price']
			];
			if(!$this->_model::where('id',$id)->update($dataUnit)){
				throw new \Exception("Update Unit is failed");
			}
			$this->transactionCommit();

			return response()->json([
				'status'=>true,
				'data'=>$data,
				'errors'=>null,
				'redirect'=>[
					'page'=>$this->_baseUrl
				],
			]);
				
		}
		catch(\Exception $e) {
			$this->transactionRollback();

			return response()->json([
				'status'=>false,
				'data'=>[],
				'errors'=>[
					'messages'=>$e->getMessage(),
				],
				'redirect'=>false,
			]);
		}
	}	
}
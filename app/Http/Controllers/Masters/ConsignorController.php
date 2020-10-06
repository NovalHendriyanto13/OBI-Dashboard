<?php
namespace App\Http\Controllers\Masters;

use App\Http\Controllers\BaseController;
use App\Models\Consignor;
use App\Form\ConsignorForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Lib\Upload;

class ConsignorController extends BaseController {
	protected $_baseUrl = 'consignor';
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

	protected function validation() {
		return [
			'code'=>'required',
			'name'=>'required',
			'phone_no'=>'required',
			'address'=>'required',
			'identity_image'=>'image|mimes:jpeg,png,jpg',
			'npwp_image'=>'image|mimes:jpeg,png,jpg',
			'spk_image'=>'image|mimes:jpeg,png,jpg',
			'spkl_image'=>'image|mimes:jpeg,png,jpg',
			'siup_image'=>'image|mimes:jpeg,png,jpg',
			'firm_domicile_image'=>'image|mimes:jpeg,png,jpg',
			'company_act_image'=>'image|mimes:jpeg,png,jpg',
		];
	}

	public function createAction(Request $request) {
		$data = $request->all();
		// validation
		$validate = Validator::make($data, $this->validation());
		if ($validate->fails()) {
			return response()->json([
				'status'=>false,
				'data'=>[],
				'errors'=>[
					'messages'=>$validate->messages()->getMessages(),
				],
				'redirect'=>false,
			]);
		}
		
		$images = [
			'identity_image',
			'npwp_image',
			'spk_image',
			'spkl_image',
			'siup_image',
			'firm_domicile_image',
			'company_act_image',
		];
		
		$upload = new Upload($request);
		foreach ($images as $image) {
			if($request->hasFile($image)) {
				$file = $data[$image];
				$filename = $image.'.'.$file->getClientOriginalExtension();
				
				$upload->setParam($image);
				$uploadFile = $upload->process('consignor/'.$data['code'], $filename);
				$data[$image] = $uploadFile['image_path'];
			}
		}

		if($this->_model::create($data)) {
			
			$request->session()->flash('status', 'Insert was successful!');
			return response()->json([
				'status'=>true,
				'data'=>$data,
				'errors'=>null,
				'redirect'=>[
					'page'=>$this->_baseUrl
				],
			]);
		}
		
		return response()->json([
			'status'=>false,
			'data'=>[],
			'errors'=>[
				'messages'=>'Invalid Input',
			],
			'redirect'=>false,
		]);
	}

	public function updateAction(Request $request, $id) {
		$data = $request->all();

		// validation
		$validate = Validator::make($data, $this->validation());
		if ($validate->fails()) {
			return response()->json([
				'status'=>false,
				'data'=>[],
				'errors'=>[
					'messages'=>$validate->messages()->getMessages(),
				],
				'redirect'=>false,
			]);
		}

		$images = [
			'identity_image',
			'npwp_image',
			'spk_image',
			'spkl_image',
			'siup_image',
			'firm_domicile_image',
			'company_act_image',
		];
		$upload = new Upload($request);
		foreach ($images as $image) {
			if($request->hasFile($image)) {
				$file = $data[$image];
				$filename = $image.'.'.$file->getClientOriginalExtension();
				
				$upload->setParam($image);
				$uploadFile = $upload->process('consignor/'.$data['code'], $filename);
				$data[$image] = $uploadFile['image_path'];
			}
		}

		$model = $this->_model::where('id',$id);
		$latestData = $model->first();
		if($model->update($data)) {
			foreach ($images as $image) {
				$uploadClass = new Upload;
				$uploadClass->removeFile($latestData->$image);
			}

			$request->session()->flash('status', 'Update was successful!');
			return response()->json([
				'status'=>true,
				'data'=>$data,
				'errors'=>null,
				'redirect'=>[
					'page'=>$this->_baseUrl
				],
			]);
		}
		
		return response()->json([
			'status'=>false,
			'data'=>[],
			'errors'=>[
				'messages'=>'Invalid Input',
			],
			'redirect'=>false,
		]);
	}
}
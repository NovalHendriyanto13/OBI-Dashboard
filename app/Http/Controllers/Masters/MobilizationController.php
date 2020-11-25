<?php
namespace App\Http\Controllers\Masters;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Mobilization;
use App\Form\MobilizationForm;
use App\Tools\DataTable;

class MobilizationController extends BaseController {
	protected $_baseUrl = 'mobilization';
	protected $_title = 'Mobilization';
	protected $_model = Mobilization::class;

	public function listByUnit(Request $request, $unitId) {
		$model = $this->_model::where('unit_id', $unitId)->get();
		$setting = [
			'table'=>[
				'columns'=>[
					[
						'name'=>'id',
						'title'=>'ID',
						'visible'=>false,
					],
					[
						'name'=>'from_date',
						'title'=>'From Date',
						'visible'=>true,
					],
					[
						'name'=>'to_date',
						'title'=>'To Date',
						'visible'=>true,
					],
					[
						'name'=>'pic_name',
						'title'=>'Pic Name',
						'visible'=>true,
					],
					[
						'name'=>'mobilize_from',
						'title'=>'From',
						'visible'=>true,
					],
					[
						'name'=>'mobilize_to',
						'title'=>'From',
						'visible'=>true,
					],
				],
				'grid_actions'=>[
					[
						'icon'=>'edit',
						'class'=>'btn-primary',
						'title'=>'Update',
						'url'=>url('mobilization/update'),
						'allow'=>true
					],
					[
						'icon'=>'book-open',
						'class'=>'btn-primary',
						'title'=>'Detail',
						'url'=>url('mobilization/detail'),
						'allow'=>true
					],
				],
			]
		];
		return DataTable::build($model, $setting)->make(true);
	}
	
	public function createByUnitId($unitId) {
        $form = $this->setForm() === null ? null : $this->setForm();
		
		$data = [
			'form' => new $form(null, ['unit_id'=>$unitId]),
			'action_buttons'=>[
				[
					'icon'=>'x-circle',
					'class'=>'btn-white',
					'title'=>'Cancel',
					'url'=>route('unit.update',['id'=>$unitId]),
					'type'=>'link',
				],
				[
					'icon'=>'check-circle',
					'class'=>'btn-primary',
					'title'=>'Submit',
					'type'=>'button'
				],
			]
		];
		return view($this->_baseView.'.create')->with($data);
    }

    protected function setForm() {
        return MobilizationForm::class;
    }

    public function createAction(Request $request) {
        $data = $request->all();
        $data['from_time'] = convert_date($data['from_time'], 'Y-m-d H:i:s');
        $data['to_time'] = convert_date($data['to_time'], 'Y-m-d H:i:s');
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

		if($this->_model::create($data)) {
			$request->session()->flash('status', 'Create was successful!');
			return response()->json([
				'status'=>true,
				'data'=>$data,
				'errors'=>null,
				'redirect'=>[
					'page'=>'unit/update/'.$data['unit_id']
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
        $data['from_time'] = convert_date($data['from_time'], 'Y-m-d H:i:s');
        $data['to_time'] = convert_date($data['to_time'], 'Y-m-d H:i:s');
        
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

		if($this->_model::where('id',$id)->update($data)) {
			$request->session()->flash('status', 'Update was successful!');
			return response()->json([
				'status'=>true,
				'data'=>$data,
				'errors'=>null,
				'redirect'=>[
					'page'=>'unit/update/'.$data['unit_id']
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
	
	public function detail(Request $request, $id) {
		$model = $this->_model::find($id);
		$form = $this->setForm();
		
		$data = [
			'id'=>$id,
			'form' => new $form($model, ['mode'=>'detail']),
			'action_buttons'=> [
				[
					'icon'=>'list',
					'class'=>'btn-dark',
					'title'=>'List',
					'url'=>route('unit.update', ['id'=>$model->unit_id]),
					'type'=>'link',
				],
				[
					'icon'=>'plus-circle',
					'class'=>'btn-success',
					'title'=>'Create',
					'url'=>route($this->_baseUrl.'.create',['unitId'=>$model->unit_id]),
					'type'=>'link'
				],
				[
					'icon'=>'edit',
					'class'=>'btn-info',
					'title'=>'Update',
					'url'=>route($this->_baseUrl.'.update', ['id'=>$id]),
					'type'=>'link'
				],
			]
		];

		return view($this->_baseView.'.detail')->with($data);
	}
    
    protected function validation() {
        return [
			'unit_id'=>'required',
			'pic_name'=>'required',
			'from_date'=>'required',
			'to_date'=>'required',
            'mobilize_from'=>'required',
            'mobilize_to'=>'required',
            'mobilize_type'=>'required',
		];
    }
}
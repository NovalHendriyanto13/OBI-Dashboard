<?php
namespace App\Http\Controllers\Userlist;

use App\Http\Controllers\BaseController;
use App\Models\Bidder;
use App\Models\User;
use App\Models\Group;
use App\Form\BidderForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Lib\Upload;
use App\Tools\DataTable;

class BidderController extends BaseController {
	protected $_baseUrl = 'bidder';
	protected $_title = 'Bidder';
	protected $_model = Bidder::class;

	protected function indexData() {
		return [
			'table'=>[
				'searchable'=>true,
				'columns'=>[
					[
						'name'=>'id',
						'title'=>'ID',
						'visible'=>false,
					],
					[
						'name'=>'first_name',
						'title'=>'Name',
						'visible'=>true,
						'search'=>[
							'type'=>'text'
						]
					],
					[
						'name'=>'email',
						'title'=>'Email',
						'visible'=>true,
						'search'=>[
							'type'=>'text'
						]
					],
					[
						'name'=>'phone_no',
						'title'=>'Phone',
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
		return BidderForm::class;
	}

	protected function validation() {
		return [
            'first_name'=>'required',
            'phone_no'=>'required',
            'address'=>'required',
            'email'=>'required',
            'identity_image'=>'image|mimes:jpeg,png,jpg|required',
            'identity_type'=>'required',
            'identity_no'=>'required',
            'account_bank'=>'required',
            'account_name'=>'required',
            'account_no'=>'required',
            'account_branch'=>'required',
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
		];
		
		$upload = new Upload($request);
		foreach ($images as $image) {
			if($request->hasFile($image)) {
				$file = $data[$image];
				$filename = $image.'.'.$file->getClientOriginalExtension();
				
				$upload->setParam($image);
				$uploadFile = $upload->process('bidder/'.$data['identity_no'], $filename);
				$data[$image] = $uploadFile['image'];
			}
		}

		if($insertId = $this->_model::create($data)) {
            // upsert to user
            $this->upsertUser($data,$insertId);

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
		];
		$upload = new Upload($request);
		foreach ($images as $image) {
			if($request->hasFile($image)) {
				$file = $data[$image];
				$filename = $image.'.'.$file->getClientOriginalExtension();
				
				$upload->setParam($image);
				$uploadFile = $upload->process('bidder/'.$data['identity_no'], $filename);
				$data[$image] = $uploadFile['image'];
			}
		}

		$model = $this->_model::where('id',$id);
		$latestData = $model->first();
		if($model->update($data)) {
			foreach ($images as $image) {
				$uploadClass = new Upload;
				$uploadClass->removeFile($latestData->$image);
			}

            // upsert to user
            $this->upsertUser($data,$id);

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
	
	public function dataList(Request $request) {
		if (is_null($this->_model))
			return [];

		$model = $this->_model::get();
		$setting = $this->indexData();

		$customFilters = $request->get('custom_filters');
		if (!is_null($customFilters)) {
			$model = $this->_model::query();
			
			if($fname = $customFilters['first_name']) {
				$model = $model->where('first_name','like','%'.$fname.'%');
			}

			if($email = $customFilters['email']) {
				$model = $model->where('email','like','%'.$email.'%');
			}
		}
		return DataTable::build($model, $setting)->make(true);
	}
    
    private function upsertUser($data, $id) {
        $group = Group::firstWhere('name','user');

        return User::updateOrCreate([
            'bidder_id'=>$id
        ], [
            'username'=>$data['email'],
            'name'=>$data['first_name'].' '.$data['last_name'],
            'email'=>$data['email'],
            'group_id'=>$group->id,
            'password'=>Hash::make('otobid123')
        ]);
    }
}
<?php
namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\BaseController;
use App\Models\User;
use App\Form\UserForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class UserController extends BaseController {

	protected $_baseUrl = 'user';
	protected $_title = 'User';
	protected $_model = User::class;

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
						'name'=>'name',
						'title'=>'Name',
						'visible'=>true,
					],
					[
						'name'=>'username',
						'title'=>'Username',
						'visible'=>true,
					],
					[
						'name'=>'email',
						'title'=>'Email',
						'visible'=>true,
					],
					[
						'name'=>'group.name',
						'title'=>'Group',
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

	protected function retrieveData(Request $request) {
		return $this->_model::where('group_id','<>','1')
			->where('status',1)
			->get();
	}

	protected function setForm() {
		return UserForm::class;
	}

	protected function additionalParams(Request $request) {
		return [
			'password' => Hash::make('otobid123')
		];
	}

	protected function validation() {
		return [
			'name'=>'required',
			'username'=>'required',
			'email'=>'required|email',
			'group_id'=>'required'
		];
	}

	public function createAction(Request $request) {
		$data = $request->all();
		
		$data = array_merge($data, $this->additionalParams($request));
		
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

		// check unique email or username
		$user = $this->_model::where('email', $data['email'])
			->orWhere('username', $data['username'])
			->first();
		
		if ($user) {
			return response()->json([
				'status'=>false,
				'data'=>[],
				'errors'=>[
					'messages'=>[
						'username'=>['Username must be Unique'],
						'email'=>['Email muse be Unique']
					],
				],
				'redirect'=>false,
			]);
		}

		if($this->_model::create($data)) {
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

	public function getName(Request $request) {
		$data = $request->all();
		$user = $this->_model::where('id',$data['value'])->first();
		if ($user) {
			return response()->json([
				'status'=>true,
				'data'=>[
					'value'=>$user->name,
				],
				'errors'=>null,
				'redirect'=>false,
			]); 
		}
		return response()->json([
			'status'=>false,
			'data'=>[],
			'errors'=>[
				'messages'=> 'No Users Found',
			],
			'redirect'=>false,
		]); 
	}
}
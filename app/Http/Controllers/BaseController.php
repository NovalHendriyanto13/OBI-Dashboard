<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Tools\DataTable;

use App\Tools\Redis;
use App\Tools\Variable;
use Lib\Upload;

use App\Traits\DbTrait;

class BaseController extends Controller {
	use DbTrait;
	
	protected $_baseUrl;
	protected $_baseView = 'default';
	protected $_title = 'Application';
	protected $_model;

	public function __construct() {
		$global = Variable::set([
			'title'=>$this->_title,
			'base_url' => $this->_baseUrl,
		]);
	}
	public function index(Request $request) {
		if (count($request->all()) > 0 ) {
			$this->bulkActions($request);
			return response()->json([
				'status'=>true,
				'data'=>$request->all(),
				'errors'=>null,
				'redirect'=>[
					'page'=>$this->_baseUrl
				],
			]);
		}
		$data = [
			'data'	=> [
				'setting'=>$this->indexData(),
			],
		];
		return view($this->_baseView.'.index')->with($data);
	}

	public function dataList(Request $request) {
		if (is_null($this->_model))
			return [];

		$model = $this->_model::get();
		$setting = $this->indexData();
		
		return DataTable::build($model, $setting)->make(true);
	}
	
	protected function indexData() {
		return [
			'table'=>[],
			'action_buttons'=>[]
		];
	}

	public function create() {
		$form = $this->setForm() === null ? null : $this->setForm();
		
		$data = [
			'form' => new $form,
			'action_buttons'=>[]
		];
		return view($this->_baseView.'.create')->with($data);
	}

	protected function setForm() { return null; }

	public function createAction(Request $request) {
		$data = $request->all();
		
		$data = array_merge($data, $this->additionalParams($request));
		
		// filter 
		$filter = $this->filterParam($data);
		if (is_array($filter)) {
			return response()->json($filter);
		}

		foreach($this->unsetParam() as $unset) {
			unset($data[$unset]);
		}

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

	public function update($id) {
		$model = $this->_model::find($id);
		$form = $this->setForm();
		
		$data = [
			'id'=>$id,
			'form' => new $form($model, ['mode'=>'edit']),
		];

		return view($this->_baseView.'.update')->with($data);
	}

	public function updateAction(Request $request, $id) {
		$data = $request->all();

		$data = array_merge($data, $this->additionalParams($request));

		// filter 
		$filter = $this->filterParam($data);
		if (is_array($filter)) {
			return response()->json($filter);
		}

		foreach($this->unsetParam() as $unset) {
			unset($data[$unset]);
		}

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
					'url'=>route($this->_baseUrl.'.index'),
					'type'=>'link',
				],
				[
					'icon'=>'plus-circle',
					'class'=>'btn-success',
					'title'=>'Create',
					'url'=>route($this->_baseUrl.'.create'),
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

	protected function additionalParams(Request $request) { return []; }

	protected function filterParam(Array $data) {
		if (array_key_exists('errors', $data)) {
			return [
				'status'=>false,
				'data'=>[],
				'errors'=>[
					'messages'=>$data['errors'],
				],
				'redirect'=>false,
			];
		}

		return true;
	}

	protected function unsetParam() { return []; }

	protected function validation() { return []; }

	protected function bulkActions(Request $request) { }
}
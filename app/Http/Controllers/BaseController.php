<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Tools\Redis;
use App\Tools\Variable;

class BaseController extends Controller {
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

		$data = [
			'data'	=> [
				'model'=>$this->retrieveData($request),
				'setting'=>$this->indexData(),
			],
		];
		return view($this->_baseView.'.index')->with($data);
	}

	protected function retrieveData(Request $request) {
		if (is_null($this->_model))
			return [];

		return $this->_model::get();
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
		];
		return view($this->_baseView.'.create')->with($data);
	}

	protected function setForm() { return null; }

	public function createAction(Request $request) {
		$data = $request->all();
		unset($data['_token']);

		if($this->_model::create($data)) {
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
			'form' => new $form($model),
		];

		return view($this->_baseView.'.update')->with($data);
	}

	public function updateAction(Request $request, $id) {
		$data = $request->all();
		unset($data['_token']);

		if($this->_model::where('id',$id)->update($data)) {
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
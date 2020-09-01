<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Tools\Redis;

class BaseController extends Controller {
	protected $_baseUrl;
	protected $_baseView = 'default';
	protected $_title = 'Application';
	protected $_model;

	public function index(Request $request) {
		$data = [
			'title' => $this->_title,
			'data'	=> $this->retrieveData($request),
			'userInfo'  => Auth::user(),
		];
		return view($this->_baseView.'.index')->with($data );
	}

	public function retrieveData(Request $request) {
		if (is_null($this->_model))
			return [];

		return $this->_model::all();
	}

	public function create() {
		$data = [
			'title'=>$this->_title.' Create',
			'userInfo'  => Auth::user(),
		];

		return view($this->_baseView.'.create')->with($data);
	}

	public function insertData(Request $request) {}

	public function update($id) {
		$data = [
			'title'=>$this->_title.' Update',
			'data'=>$this->getSingleData($id),
			'userInfo'  => Auth::user(),
		];

		return view($this->_baseView.'.update')->with($data);
	}

	protected function tableSetting() {
		
	}

	private function _getUserInfo() {

	}
}
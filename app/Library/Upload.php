<?php
namespace Lib;

use Illuminate\Http\Request;

class Upload {
	
	protected $request;
	protected $file;

	private $_imagePath;
	private $_thumbPath;

	public function __construct(Request $request = null) {
		$this->request = $request;
		$this->_imagePath = public_path(config('app.image_path.original'));
		$this->_thumbPath = public_path(config('app.image_path.thumbnail'));
	}
	public function setParam(String $param) {
		$this->file = $this->request->file($param);
	}
	public function process($path, $filename) {
		$newPath = config('app.image_path.original').$path.'/';
		if (!is_dir($this->_imagePath.$path)) {
			$newPath = $this->createDir($path);
		}
		if ($this->file) {
			if ($this->file->move($newPath, $filename)) {
				return [
					'status'=>true,
					'message'=>'Upload image is success',
					'image_path'=> $path.'/'.$filename,
					'path'=>$path,
				];
			}

			return [
				'status'=>true,
				'message'=>'Upload image is failed',
				'image_path'=>'',
				'path'=>'',
			];
		}
		return [
			'status'=>false,
			'message'=>'No Parameter Found',
			'image_path'=>'',
		];
	}
	public function createDir(String $path) {
		$explodePath = explode('/', $path);

		$folderPath = '';
		for($i=0; $i < count($explodePath); $i++) {
			$folder = $explodePath[$i];
			// check if folder exists
			$folderPath .= $folder;
			if(!is_dir($this->_imagePath.$folderPath)) {
				mkdir($this->_imagePath.$folderPath);
			}
			$folderPath .= '/';
		}

		return $folderPath;
	}

	public function removeFile(String $path=null) {
		if(is_file($this->_imagePath.$path))
			unlink($this->_imagePath.$path);

		return true;
	}
}
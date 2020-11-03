<?php
namespace App\Http\Controllers\Masters;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use App\Models\Mobilization;
use App\Form\MobilizationForm;

class MobilizationController extends BaseController {
	protected $_baseUrl = 'mobilization';
	protected $_title = 'Mobilization';
    protected $_model = Mobilization::class;
    
    public function createByUnitId($unitId) {
        $form = $this->setForm() === null ? null : $this->setForm();
		
		$data = [
			'form' => new $form,
		];
		return view($this->_baseView.'.create')->with($data);
    }

    protected function setForm() {
        return MobilizationForm::class;
    }

}
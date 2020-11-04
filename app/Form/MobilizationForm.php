<?php
namespace App\Form;

use Lib\Form;
use App\View\Components\InputText;
use App\View\Components\InputSelect;
use App\View\Components\TextArea;
use App\View\Components\InputHidden;

use App\Models\Mobilization;
use App\Models\User;
use App\Models\Group;
use App\Models\BaseTable;

class MobilizationForm extends Form {
	
	protected function initialize($entity=null, array $options) {
		$mode = '';
		$disabled = false;
		if (isset($options['mode'])) {
			if ($options['mode'] == 'edit')
				$mode = 'edit';
			elseif ($options['mode'] == 'detail') {
				$mode = 'detail';
				$disabled = true;
			}			
		}
		$defaultUnitId = isset($options['unit_id']) ? $options['unit_id'] :'';
		if (!is_null($entity)) {
			$defaultUnitId = $entity->unit_id;
			$entity->from_time = convert_date($entity->from_time, 'H:i');
			$entity->to_time = convert_date($entity->to_time, 'H:i');
		}
		$unitId = new InputHidden([
			'name'=>'unit_id',
			'class'=>'unit-id',
			'type'=>'hidden',
			'readonly'=>true,
			'required'=>true,
			'value'=>$defaultUnitId
		]);
		$this->addCollection($unitId);
		
		$picId = new InputSelect([
			'name'=>'pic_id',
			'class'=>'pic-id ajax-call',
			'ajax-href'=>url('user/get-name'),
			'ajax-to'=>'.pic-name',
			'allowEmpty'=>true,
			'options'=>$this->getPic(),
			'disabled'=>$disabled,
		]);
		$this->addCollection($picId);

		$picName = new InputText([
			'name'=>'pic_name',
			'class'=>'pic-name',
			'type'=>'text',
			'required'=>true,
			'disabled'=>$disabled,
		]);
		$this->addCollection($picName);

		$fromDate = new InputText([
			'name'=>'from_date',
			'class'=>'from-date datepicker',
			'type'=>'text',
			'required'=>true,
			'disabled'=>$disabled,
		]);
		$this->addCollection($fromDate);

		$fromTime = new InputText([
			'name'=>'from_time',
			'class'=>'from-time timepicker',
			'allowEmpty'=>true,
			'disabled'=>$disabled,
		]);
		$this->addCollection($fromTime);

		$toDate = new InputText([
			'name'=>'to_date',
			'class'=>'to-date datepicker',
			'required'=>true,
			'allowEmpty'=>true,
			'disabled'=>$disabled,
		]);
		$this->addCollection($toDate);
		
		$toTime = new InputText([
			'name'=>'to_time',
			'class'=>'to-time timepicker',
			'allowEmpty'=>true,
			'disabled'=>$disabled,
		]);
		$this->addCollection($toTime);

		$mobilizeFrom = new InputText([
			'name'=>'mobilize_from',
			'class'=>'mobilize-from',
			'label'=>'From',
			'required'=>true,
			'disabled'=>$disabled,
		]);
		$this->addCollection($mobilizeFrom);

		$mobilizeTo = new InputText([
			'name'=>'mobilize_to',
			'class'=>'mobilize-to',
			'label'=>'To',
			'required'=>true,
			'disabled'=>$disabled,
		]);
		$this->addCollection($mobilizeTo);

		$type = new InputSelect([
			'name'=>'mobilize_type',
			'class'=>'mobilize-type',
			'label'=>'Type',
			'required'=>true,
			'allowEmpty'=>true,
			'disabled'=>$disabled,
			'options'=>[
				'Drivable',
				'Towing',
				'Car Carrier',
				'Shipping',
				'Diantar'
			]
		]);
		$this->addCollection($type);

		$parking = new InputText([
			'name'=>'parking',
			'class'=>'parking',
			'disabled'=>$disabled,
		]);
		$this->addCollection($parking);

		$reparation = new InputText([
			'name'=>'reparation',
			'class'=>'reparation',
			'disabled'=>$disabled,
		]);
		$this->addCollection($reparation);

		$subtotal = new InputText([
			'name'=>'subtotal',
			'class'=>'subtotal',
			'disabled'=>$disabled,
		]);
		$this->addCollection($subtotal);

		$actualFee = new InputText([
			'name'=>'actual_fee',
			'class'=>'actual-fee',
			'disabled'=>$disabled,
		]);
		$this->addCollection($actualFee);

		$information = new TextArea([
			'name'=>'information',
			'class'=>'information',
			'readonly'=>$disabled,
		]);
		$this->addCollection($information);

		parent::initialize($entity, $options);
	}
	private function getPic() {
		$group = Group::where('name','admin')->first();
		return User::select('id', 'name')
			->where(['group_id'=>$group->id])
			->get();
	}
}
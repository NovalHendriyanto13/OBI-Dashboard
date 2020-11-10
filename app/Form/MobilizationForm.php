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
use App\Models\Consignor;
use App\Models\UnitType;
use App\Models\Area;
use App\Models\Unit;
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
		
		// unit
		$this->getUnit($defaultUnitId);

		parent::initialize($entity, $options);
	}
	private function getPic() {
		$group = Group::where('name','admin')->first();
		return User::select('id', 'name')
			->where(['group_id'=>$group->id])
			->get();
	}
	private function getUnit($id) {
		$unit = Unit::find($id);
		$code = new InputText([
			'name'=>'unit_code',
			'class'=>'unit-code',
			'type'=>'text',
			'disabled'=>true,
			'value'=>$unit->unit_code,
		]);
		$this->addCollection($code, 'Unit Info');
		
		$policeNo = new InputText([
			'name'=>'police_number',
			'class'=>'police-number',
			'type'=>'text',
			'disabled'=>true,
			'value'=>$unit->police_number,
		]);
		$this->addCollection($policeNo, 'Unit Info');

		$consignor = new InputSelect([
			'name'=>'consignor_id',
			'label'=>'Consignor',
			'class'=>'consignor-id',
			'allowEmpty'=>true,
			'options'=>Consignor::select('id','name')->get(),
			'disabled'=>true,
			'value'=>$unit->consignor_id,
		]);
		$this->addCollection($consignor, 'Unit Info');

		$unitType = new InputSelect([
			'name'=>'unit_type_id',
			'label'=>'Unit Type',
			'class'=>'unit-type-id',
			'disabled'=>true,
			'allowEmpty'=>true,
			'options'=>UnitType::select('id','name')->get(),
			'value'=>$unit->unit_type_id,
		]);
		$this->addCollection($unitType, 'Unit Info');

		$area = new InputSelect([
			'name'=>'area_id',
			'label'=>'Area',
			'class'=>'area-id',
			'disabled'=>true,
			'allowEmpty'=>true,
			'options'=>Area::select('id','name')->get(),
			'value'=>$unit->area_id,
		]);
		$this->addCollection($area, 'Unit Info');

		$year = new InputText([
			'name'=>'year',
			'class'=>'year',
			'type'=>'number',
			'disabled'=>true,
			'value'=>$unit->year,
		]);
		$this->addCollection($year, 'Unit Info');

		$transmission = new InputSelect([
			'name'=>'transmission',
			'class'=>'transmission',
			'label'=>'Transmission',
			'disabled'=>true,
			'allowEmpty'=>true,
			'value'=>$unit->transmission,
			'options'=>[
				'MT'=>'Manual',
				'AT'=>'Matic',
			],
		]);
		$this->addCollection($transmission, 'Unit Info');

		$kilometers = new InputText([
			'name'=>'kilometers',
			'class'=>'kilometers',
			'type'=>'number',
			'disabled'=>true,
			'value'=>$unit->kilometers,
		]);
		$this->addCollection($kilometers, 'Unit Info');

		$color = new InputText([
			'name'=>'color',
			'class'=>'color',
			'type'=>'text',
			'disabled'=>true,
			'value'=>$unit->color,
		]);
		$this->addCollection($color, 'Unit Info');

		$frame = new InputText([
			'name'=>'frame_number',
			'class'=>'frame-number',
			'type'=>'text',
			'disabled'=>true,
			'value'=>$unit->frame,
		]);
		$this->addCollection($frame, 'Unit Info');

		$machine = new InputText([
			'name'=>'machine_number',
			'class'=>'machine_number',
			'type'=>'text',
			'disabled'=>true,
			'value'=>$unit->machine,
		]);
		$this->addCollection($machine, 'Unit Info');

		$cylinder = new InputText([
			'name'=>'cylinder',
			'class'=>'cylinder',
			'type'=>'text',
			'disabled'=>true,
			'value'=>$unit->cylinder,
		]);
		$this->addCollection($cylinder, 'Unit Info');

		$status = new InputSelect([
			'name'=>'status',
			'class'=>'status',
			'disabled'=>true,
			'value'=>$unit->status,
			'options'=>[
				1=>'Ready',
				0=>'Disable',
				2=>'Sold',
				3=>'Wanpress',
			],
		]);
		$this->addCollection($status, 'Unit Info');
	}
}
<?php
namespace App\Form;

use Lib\Form;
use App\View\Components\InputText;
use App\View\Components\InputSelect;
use App\View\Components\TextArea;

use App\Models\Area;
use App\Models\Consignor;
use App\Models\UnitType;
use App\Models\Brand;
use App\Models\BaseTable;

class UnitForm extends Form {
	
	protected function initialize($entity=null, array $options) {
		$mode = '';
		if (isset($options['mode'])) {
			if ($options['mode'] == 'edit')
				$mode = 'edit';
			elseif ($options['mode'] == 'detail')
				$mode = 'detail';
		}
		
		$defaultCode = date('Ym').str_pad(rand(0,100000),6,"0",STR_PAD_LEFT);
		if ($mode == 'edit')
			$defaultCode = $entity->unit_code;

		$code = new InputText([
			'name'=>'unit_code',
			'class'=>'unit-code',
			'type'=>'text',
			'readonly'=>true,
			'value'=>$defaultCode,
			'required'=>true,
		]);
		$this->addCollection($code);
		
		$policeNo = new InputText([
			'name'=>'police_number',
			'class'=>'police-number',
			'type'=>'text',
			'required'=>true,
		]);
		$this->addCollection($policeNo);

		$brand = new InputSelect([
			'name'=>'brand_id',
			'class'=>'brand',
			'required'=>true,
			'allowEmpty'=>true,
			'options'=>$this->getBrand(),
		]);
		$this->addCollection($brand);

		$consignor = new InputSelect([
			'name'=>'consignor_id',
			'label'=>'Consignor',
			'class'=>'consignor-id',
			'required'=>true,
			'allowEmpty'=>true,
			'options'=>Consignor::select('id','name')->get(),
		]);
		$this->addCollection($consignor);

		$unitType = new InputSelect([
			'name'=>'unit_type_id',
			'label'=>'Unit Type',
			'class'=>'unit-type-id',
			'required'=>true,
			'allowEmpty'=>true,
			'options'=>UnitType::select('id','name')->get(),
		]);
		$this->addCollection($unitType);

		$area = new InputSelect([
			'name'=>'area_id',
			'label'=>'Area',
			'class'=>'area-id',
			'required'=>true,
			'allowEmpty'=>true,
			'options'=>Area::select('id','name')->get(),
		]);
		$this->addCollection($area);

		$year = new InputText([
			'name'=>'year',
			'class'=>'year',
			'type'=>'number',
		]);
		$this->addCollection($year);

		$transmission = new InputSelect([
			'name'=>'transmission',
			'class'=>'transmission',
			'label'=>'Transmission',
			'required'=>true,
			'allowEmpty'=>true,
			'options'=>[
				'MT'=>'Manual',
				'AT'=>'Matic',
			],
		]);
		$this->addCollection($transmission);

		$kilometers = new InputText([
			'name'=>'kilometers',
			'class'=>'kilometers',
			'type'=>'number',
		]);
		$this->addCollection($kilometers);

		$color = new InputText([
			'name'=>'color',
			'class'=>'color',
			'type'=>'text',
		]);
		$this->addCollection($color);

		$frame = new InputText([
			'name'=>'frame_number',
			'class'=>'frame-number',
			'type'=>'text',
		]);
		$this->addCollection($frame);

		$machine = new InputText([
			'name'=>'machine_number',
			'class'=>'machine_number',
			'type'=>'text',
		]);
		$this->addCollection($machine);

		$cylinder = new InputText([
			'name'=>'cylinder',
			'class'=>'cylinder',
			'type'=>'text',
		]);
		$this->addCollection($cylinder);

		$status = new InputSelect([
			'name'=>'status',
			'class'=>'status',
			'options'=>[
				1=>'Ready',
				0=>'Disable',
				2=>'Sold',
				3=>'Wanpress',
			],
		]);
		$this->addCollection($status);

		$internal = new TextArea([
			'name'=>'internal_info',
			'class'=>'internal-info',
		]);
		$this->addCollection($internal);

		$information = new TextArea([
			'name'=>'information',
			'class'=>'information',
		]);
		$this->addCollection($information);

		$comment = new TextArea([
			'name'=>'comment',
			'class'=>'comment',
		]);
		$this->addCollection($comment);

		// info
		$bpkb = new InputText([
			'name'=>'bpkb',
			'class'=>'bpkb',
			'type'=>'text',
		]);
		$this->addCollection($bpkb, 'Info');

		$bpkbName = new InputText([
			'name'=>'bpkb_name',
			'class'=>'bpkb-name',
			'type'=>'text',
		]);
		$this->addCollection($bpkbName, 'Info');

		$invoice = new InputText([
			'name'=>'invoice',
			'class'=>'invoice',
			'type'=>'text',
		]);
		$this->addCollection($invoice, 'Info');

		$receipt = new InputText([
			'name'=>'receipt',
			'class'=>'receipt',
			'type'=>'text',
		]);
		$this->addCollection($receipt, 'Info');

		$stnkDate = new InputText([
			'name'=>'stnk_date',
			'class'=>'stnk-date datepicker',
			'type'=>'text',
		]);
		$this->addCollection($stnkDate, 'Info');

		$taxDate = new InputText([
			'name'=>'tax_date',
			'class'=>'tax-date datepicker',
			'type'=>'text',
		]);
		$this->addCollection($taxDate, 'Info');

		$machineGrade = new InputSelect([
			'name'=>'machine_grade',
			'class'=>'machine-grade',
			'allowEmpty'=>true,
			'options'=>$this->getGrade(),
		]);
		$this->addCollection($machineGrade, 'Info');

		$interiorGrade = new InputSelect([
			'name'=>'interior_grade',
			'class'=>'interior-grade',
			'allowEmpty'=>true,
			'options'=>$this->getGrade(),
		]);
		$this->addCollection($interiorGrade, 'Info');

		$exteriorGrade = new InputSelect([
			'name'=>'exterior_grade',
			'class'=>'exterior-grade',
			'allowEmpty'=>true,
			'options'=>$this->getGrade(),
		]);
		$this->addCollection($exteriorGrade, 'Info');

		$limitPrice = new InputText([
			'name'=>'limit_price',
			'class'=>'limit-price',
			'type'=>'number',
		]);
		$this->addCollection($limitPrice, 'Info');

		parent::initialize($entity, $options);
	}

	private function getBrand() {
		$tbl = BaseTable::TBL_BRAND;
		$brands = Brand::select($tbl.'.id',$tbl.'.name','b.name AS parent')
			->Join(BaseTable::TBL_BRAND.' AS b', $tbl.'.parent_id','=','b.id')
			->orderBy($tbl.'.parent_id')
			->get();

		$options = [];
		foreach($brands as $brand) {
			$key = $brand->id;
			$value = $brand->parent. ' - '.$brand->name;
			$options[$key] = $value;
		}
		return $options;
	}

	private function getGrade() {
		return [
			'E','D','C','B','A'
		];
	}
}
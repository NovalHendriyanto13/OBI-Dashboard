<?php
namespace App\Form;

use Lib\Form;
use App\View\Components\InputText;
use App\View\Components\InputSelect;
use App\View\Components\TextArea;
use App\View\Components\InputImage;

use App\Models\Area;

class AuctionForm extends Form {
	
	protected function initialize($entity=null, array $options) {
		$mode = '';
		if (isset($options['mode']) && $options['mode'] == 'edit')
			$mode = 'edit';

		if ($mode == 'edit') {
			$entity->start_time = date('H:i', strtotime($entity->start_time));
			$entity->end_time = date('H:i', strtotime($entity->end_time));
		}
		
		$area = new InputSelect([
            'name'=>'area_id',
            'label'=>'Area',
			'class'=>'area-id ajax-call',
			'allowEmpty'=>true,
            'required'=>true,
            'ajax-href'=>url('area/get-code'),
			'ajax-to'=>'.auction-code',
            'options'=>Area::where('type',1)->select('id','name')->get()
		]);
        $this->addCollection($area);
        
        $code = new InputText([
			'name'=>'auction_code',
			'class'=>'auction-code',
            'type'=>'text',
            'required'=>true,
            'readonly'=>true,
		]);
		$this->addCollection($code);
        
        $auctionDate = new InputText([
            'name'=>'auction_date',
            'required'=>true,
            'class'=>'auction-date datepicker'
		]);
        $this->addCollection($auctionDate);

		$isOnline = new InputSelect([
			'name'=>'is_online',
			'class'=>'is-online',
            'required'=>true,
            'options'=>[
                1=>'Yes',
                0=>'No'
            ]
		]);
		$this->addCollection($isOnline);

        $startTime = new InputText([
			'name'=>'start_time',
			'class'=>'start-time timepicker',
            'type'=>'text',
            'required'=>true
		]);
		$this->addCollection($startTime);

		$endTime = new InputText([
			'name'=>'end_time',
			'class'=>'end-time timepicker',
			'type'=>'text',
			'required'=>true,
		]);
        $this->addCollection($endTime);
        
        $openHouseDate = new InputText([
			'name'=>'open_house_date',
			'class'=>'open-house-date datepicker',
            'type'=>'text',
            'required'=>true
		]);
		$this->addCollection($openHouseDate);

		$closeHouseDate = new InputText([
			'name'=>'close_house_date',
			'class'=>'close-house-date datepicker',
            'type'=>'text',
            'required'=>true
		]);
		$this->addCollection($closeHouseDate);
		
		$documentNo = new InputText([
			'name'=>'document_no',
			'class'=>'document-no',
			// 'label'=>'Risalah No.',
			'type'=>'text',
			'required'=>true,
		]);
		$this->addCollection($documentNo);
		
		$documentFile = new InputText([
			'name'=>'document_file',
			'class'=>'document-file',
			'type'=>'file',
            'required'=>true
		]);
		$this->addCollection($documentFile);

		$depositDate = new InputText([
			'name'=>'deposit_date',
			'class'=>'deposit-date datepicker',
		]);
		$this->addCollection($depositDate);

		$auctionOfficer = new InputText([
			'name'=>'auction_officer',
			'class'=>'auction-officer',
			'type'=>'text',
			'required'=>true,
		]);
		$this->addCollection($auctionOfficer);
        
        $status = new InputSelect([
			'name'=>'status',
			'class'=>'status',
			'required'=>true,
			'options'=>[
				'In Active', 'Active', 'Finish', 'Cancel'
			]
		]);
        $this->addCollection($status);

		parent::initialize($entity, $options);
	}

	private function auctionDetail() {
		
	}
}
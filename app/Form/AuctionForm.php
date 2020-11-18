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
		
		$area = new InputSelect([
            'name'=>'area_id',
            'label'=>'Area',
			'class'=>'area-id',
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
        
		$identImage = new InputImage([
			'name'=>'identity_image',
            'class'=>'identity_image',
            'required'=>true
		]);
		$this->addCollection($identImage);

		$email = new InputText([
			'name'=>'email',
			'class'=>'email',
            'type'=>'email',
            'required'=>true
		]);
		$this->addCollection($email);

		$phone = new InputText([
			'name'=>'phone_no',
			'class'=>'phone-no',
			'type'=>'text',
			'required'=>true,
		]);
		$this->addCollection($phone);

		$address = new TextArea([
			'name'=>'address',
			'class'=>'address',
			'required'=>true,
		]);
		$this->addCollection($address);

		// account info
		$accountBank = new InputText([
			'name'=>'account_bank',
			'class'=>'account-bank',
            'type'=>'text',
            'required'=>true,
		]);
        $this->addCollection($accountBank, 'Account Info');
        
        $accountBankBranch = new InputText([
			'name'=>'account_branch',
			'class'=>'account-branch',
            'type'=>'text',
            'required'=>true,
		]);
		$this->addCollection($accountBankBranch, 'Account Info');

		$accountNo = new InputText([
			'name'=>'account_no',
			'class'=>'account-no',
            'type'=>'text',
            'required'=>true
		]);
		$this->addCollection($accountNo, 'Account Info');

		$accountName = new InputText([
			'name'=>'account_name',
			'class'=>'account-name',
            'type'=>'text',
            'required'=>true,
		]);
		$this->addCollection($accountName, 'Account Info');

		parent::initialize($entity, $options);
	}
}
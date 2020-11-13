<?php
namespace App\Form;

use Lib\Form;
use App\View\Components\InputText;
use App\View\Components\InputSelect;
use App\View\Components\TextArea;
use App\View\Components\InputImage;

class BidderForm extends Form {
	
	protected function initialize($entity=null, array $options) {
		$mode = '';
		if (isset($options['mode']) && $options['mode'] == 'edit')
			$mode = 'edit';
		
		$fname = new InputText([
			'name'=>'first_name',
			'class'=>'name',
			'type'=>'text',
			'required'=>true,
		]);
        $this->addCollection($fname);
        
        $lname = new InputText([
			'name'=>'last_name',
			'class'=>'name',
			'type'=>'text',
		]);
		$this->addCollection($lname);
        
        $identType = new InputSelect([
            'name'=>'identity_type',
            'required'=>true,
			'options'=>[
				1=>'KTP',
				0=>'PASSPORT'
			],
        ]);
        $this->addCollection($identType);

		$ident = new InputText([
			'name'=>'identity_no',
			'class'=>'identity-no',
            'type'=>'text',
            'required'=>true
		]);
		$this->addCollection($ident);

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
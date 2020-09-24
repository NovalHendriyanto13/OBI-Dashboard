<?php
namespace App\Form;

use Lib\Form;
use App\View\Components\InputText;
use App\View\Components\InputSelect;
use App\View\Components\TextArea;

class AreaForm extends Form {
	
	protected function initialize($entity=null, array $options) {
		$mode = '';
		if (isset($options['mode']) && $options['mode'] == 'edit')
			$mode = 'edit';
		
		$code = new InputText([
			'name'=>'area_code',
			'class'=>'area_code',
			'type'=>'text',
			'required'=>true,
		]);
		$this->addCollection($code);
		
		$name = new InputText([
			'name'=>'name',
			'class'=>'name',
			'type'=>'text',
			'required'=>true,
		]);
		$this->addCollection($name);

		$type = new InputSelect([
			'name'=>'type',
			'class'=>'type',
			'required'=>true,
			'options'=>[
				1=>'Pool',
				0=>'Not Pool'
			],
		]);
		$this->addCollection($type);

		$zipcode = new InputText([
			'name'=>'zipcode',
			'class'=>'zipcode',
			'type'=>'text',
		]);
		$this->addCollection($zipcode);

		$phone = new InputText([
			'name'=>'phone',
			'class'=>'phone',
			'type'=>'text',
		]);
		$this->addCollection($phone);

		$email = new InputText([
			'name'=>'email',
			'class'=>'email',
			'type'=>'email',
		]);
		$this->addCollection($email);

		$increment = new InputText([
			'name'=>'increment_number',
			'class'=>'increment',
			'type'=>'text',
			'readonly'=>true,
		]);
		$this->addCollection($increment);

		$status = new InputSelect([
			'name'=>'status',
			'class'=>'status',
			'options'=>[
				1=>'Active',
				0=>'In Active'
			],
		]);
		$this->addCollection($status);

		$address = new TextArea([
			'name'=>'address',
			'class'=>'address',
		]);
		$this->addCollection($address);

		$description = new TextArea([
			'name'=>'description',
			'class'=>'description',
		]);
		$this->addCollection($description);

		// account info
		$officer = new InputText([
			'name'=>'auction_officer',
			'class'=>'auction-officer',
			'type'=>'text',
		]);
		$this->addCollection($officer, 'Account Info');

		$accountBank = new InputText([
			'name'=>'account_bank',
			'class'=>'account-bank',
			'type'=>'text',
		]);
		$this->addCollection($accountBank, 'Account Info');

		$accountBranch = new InputText([
			'name'=>'account_branch',
			'class'=>'account-branch',
			'type'=>'text',
		]);
		$this->addCollection($accountBranch, 'Account Info');

		$accountNo = new InputText([
			'name'=>'account_no',
			'class'=>'account-no',
			'type'=>'text',
		]);
		$this->addCollection($accountNo, 'Account Info');

		$accountName = new InputText([
			'name'=>'account_name',
			'class'=>'account-name',
			'type'=>'text',
		]);
		$this->addCollection($accountName, 'Account Info');

		parent::initialize($entity, $options);
	}
}
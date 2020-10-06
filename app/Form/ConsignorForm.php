<?php
namespace App\Form;

use Lib\Form;
use App\View\Components\InputText;
use App\View\Components\InputSelect;
use App\View\Components\TextArea;
use App\View\Components\InputImage;

class ConsignorForm extends Form {
	
	protected function initialize($entity=null, array $options) {
		$mode = '';
		if (isset($options['mode']) && $options['mode'] == 'edit')
			$mode = 'edit';
		
		$code = new InputText([
			'name'=>'code',
			'class'=>'code',
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

		$ident = new InputText([
			'name'=>'identity_no',
			'class'=>'identity-no',
			'type'=>'text',
		]);
		$this->addCollection($ident);

		$npwpNo = new InputText([
			'name'=>'npwp_no',
			'class'=>'npwp-no',
			'type'=>'text',
		]);
		$this->addCollection($npwpNo);

		$identImage = new InputImage([
			'name'=>'identity_image',
			'class'=>'identity_image',
		]);
		$this->addCollection($identImage);

		$npwpImage = new InputImage([
			'name'=>'npwp_image',
			'class'=>'npwp-image',
		]);
		$this->addCollection($npwpImage);

		$email = new InputText([
			'name'=>'email',
			'class'=>'email',
			'type'=>'email',
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
		$pic = new InputText([
			'name'=>'pic',
			'class'=>'pic',
			'type'=>'text',
		]);
		$this->addCollection($pic, 'Account Info');

		$picOtobid = new InputText([
			'name'=>'pic_otobid',
			'class'=>'pic-otobid',
			'type'=>'text',
		]);
		$this->addCollection($picOtobid, 'Account Info');

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

		// additional info
		$mobilization = new InputText([
			'name'=>'mobilization',
			'class'=>'mobilization',
			'type'=>'text',
		]);
		$this->addCollection($mobilization, 'Additional Info');

		$parking = new InputText([
			'name'=>'parking',
			'class'=>'parking',
			'type'=>'text',
		]);
		$this->addCollection($parking, 'Additional Info');

		$commissionType = new InputText([
			'name'=>'commission_type',
			'class'=>'commission-type',
			'type'=>'text',
		]);
		$this->addCollection($commissionType, 'Additional Info');

		$commission = new InputText([
			'name'=>'commission',
			'class'=>'commission',
			'type'=>'text',
		]);
		$this->addCollection($commission, 'Additional Info');

		$mouType = new InputText([
			'name'=>'mou_type',
			'class'=>'mou_type',
			'type'=>'text',
		]);
		$this->addCollection($mouType, 'Additional Info');

		$pksNo = new InputText([
			'name'=>'pks_no',
			'class'=>'pks-no',
			'type'=>'text',
		]);
		$this->addCollection($pksNo, 'Additional Info');

		$startMou = new InputText([
			'name'=>'start_mou',
			'class'=>'start-mou datepicker',
			'type'=>'text',
		]);
		$this->addCollection($startMou, 'Additional Info');

		$endMou = new InputText([
			'name'=>'end_mou',
			'class'=>'end-mou datepicker',
			'type'=>'text',
		]);
		$this->addCollection($endMou, 'Additional Info');

		$startPks = new InputText([
			'name'=>'start_pks',
			'class'=>'start-pks datepicker',
			'type'=>'text',
		]);
		$this->addCollection($startPks, 'Additional Info');

		$endPks = new InputText([
			'name'=>'end_pks',
			'class'=>'end-pks datepicker',
			'type'=>'text',
		]);
		$this->addCollection($endPks, 'Additional Info');

		// Upload Info
		$tdpImage = new InputImage([
			'name'=>'tdp_image',
			'class'=>'tdp-image',
		]);
		$this->addCollection($tdpImage, 'Upload Info');

		$siupImage = new InputImage([
			'name'=>'siup_image',
			'class'=>'siup-image',
		]);
		$this->addCollection($siupImage, 'Upload Info');

		$spkImage = new InputImage([
			'name'=>'spk_image',
			'class'=>'spk-image',
		]);
		$this->addCollection($spkImage, 'Upload Info');

		$spklImage = new InputImage([
			'name'=>'spkl_image',
			'class'=>'spkl-image',
		]);
		$this->addCollection($spklImage, 'Upload Info');

		$firmDomicileImage = new InputImage([
			'name'=>'firm_domicile_image',
			'class'=>'firm-domicile-image',
		]);
		$this->addCollection($firmDomicileImage, 'Upload Info');

		$companyActImage = new InputImage([
			'name'=>'company_act_image',
			'class'=>'company-act-image',
		]);
		$this->addCollection($companyActImage, 'Upload Info');

		parent::initialize($entity, $options);
	}
}
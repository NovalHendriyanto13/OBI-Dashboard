<?php
namespace App\Http\Controllers\Auctions;

use App\Http\Controllers\BaseController;
use App\Models\Auction;
use App\Form\AuctionForm;

class AuctionController extends BaseController {
    protected $_baseUrl = 'auction';
	protected $_title = 'Auction';
	protected $_model = Auction::class;

	protected function indexData() {
		return [
			'table'=>[
				'columns'=>[
					[
						'name'=>'id',
						'title'=>'ID',
						'visible'=>false,
					],
					[
						'name'=>'auction_code',
						'title'=>'ID Auction',
						'visible'=>true,
					],
					[
						'name'=>'area.name',
						'title'=>'Area',
						'visible'=>true,
					],
					[
						'name'=>'auction_date',
						'title'=>'Date',
						'visible'=>true,
					],
				],
				'grid_actions'=>[
					[
						'icon'=>'edit',
						'class'=>'btn-primary',
						'title'=>'Update',
						'url'=>url($this->_baseUrl.'/update')
					],
				],
			],
			'action_buttons'=>[
				[
					'icon'=>'plus-circle',
					'class'=>'btn-primary',
					'title'=>'Add New',
					'url'=>url($this->_baseUrl.'/create'),
					'type'=>'link',
				],
			],
		];
	}
	protected function setForm() {
		return AuctionForm::class;
	}
}
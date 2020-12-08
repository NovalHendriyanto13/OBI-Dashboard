<?php
namespace App\Http\Controllers\Auctions;

use App\Http\Controllers\BaseController;
use App\Models\Auction;
use App\Form\AuctionForm;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class AuctionController extends BaseController {
    protected $_baseUrl = 'auction';
	protected $_title = 'Auction';
	protected $_model = Auction::class;

	protected function indexData() {
		return [
			'table'=>[
				'searchable'=>true,
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
						'search'=>[
							'type'=>'text'
						]
					],
					[
						'name'=>'area.name',
						'title'=>'Area',
						'visible'=>true,
						'search'=>[
							'type'=>'text'
						]
					],
					[
						'name'=>'auction_date',
						'title'=>'Date',
						'visible'=>true,
						'transform'=> function($e) {
							return date('d-m-Y', strtotime($e));
						},
						'search'=>[
							'type'=>'date'
						]
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

	protected function validation() {
		return [
			'area_id'=>'required',
			'auction_code'=>'required',
			'auction_date'=>'required',
			'is_online'=>'required',
			'start_time'=>'required',
			'end_time'=>'required',
			'open_house_date'=>'required',
			'close_house_date'=>'required',
			'document_file'=>'required',
			'document_no'=>'required',
			'auction_officer'=>'required',
			'status'=>'required'
		];
	}

	public function createAction(Request $request) {
		$data = $request->all();
		$data['start_time'] = date('Y-m-d H:i:s', strtotime($data['auction_date'].' '.$data['start_time']));
		$data['end_time'] = date('Y-m-d H:i:s', strtotime($data['auction_date'].' '.$data['end_time']));

		// validation
		$validate = Validator::make($data, $this->validation());
		if ($validate->fails()) {
			return response()->json([
				'status'=>false,
				'data'=>[],
				'errors'=>[
					'messages'=>$validate->messages()->getMessages(),
				],
				'redirect'=>false,
			]);
		}

		if($this->_model::create($data)) {
			$request->session()->flash('status', 'Create was successful!');
			return response()->json([
				'status'=>true,
				'data'=>$data,
				'errors'=>null,
				'redirect'=>[
					'page'=>$this->_baseUrl
				],
			]);
		}
		
		return response()->json([
			'status'=>false,
			'data'=>[],
			'errors'=>[
				'messages'=>'Invalid Input',
			],
			'redirect'=>false,
		]);
	}

	public function update($id) {
		$model = $this->_model::find($id);
		$form = $this->setForm();

		$data = [
			'id'=>$id,
			'form'=>new $form($model, ['mode'=>'edit']),
			'details'=>$this->auctionDetail($id),
		];
		
		return view('auction.auction.update')->with($data);
	}

	public function updateAction(Request $request, $id) {
		$data = $request->all();
		$data['start_time'] = date('Y-m-d H:i:s', strtotime($data['auction_date'].' '.$data['start_time']));
		$data['end_time'] = date('Y-m-d H:i:s', strtotime($data['auction_date'].' '.$data['end_time']));

		// validation
		$validate = Validator::make($data, $this->validation());
		if ($validate->fails()) {
			return response()->json([
				'status'=>false,
				'data'=>[],
				'errors'=>[
					'messages'=>$validate->messages()->getMessages(),
				],
				'redirect'=>false,
			]);
		}

		foreach($this->unsetParam() as $unset) {
			unset($data[$unset]);
		}

		if($this->_model::where('id',$id)->update($data)) {
			$request->session()->flash('status', 'Update was successful!');
			return response()->json([
				'status'=>true,
				'data'=>$data,
				'errors'=>null,
				'redirect'=>[
					'page'=>$this->_baseUrl
				],
			]);
		}
		
		return response()->json([
			'status'=>false,
			'data'=>[],
			'errors'=>[
				'messages'=>'Invalid Input',
			],
			'redirect'=>false,
		]);
	}

	protected function unsetParam() {
		return ['lot_no', 'unit_unit_code','action_bulk'];
	}

	private function auctionDetail($id) {
		return [
			'setting'=>[
				'table'=>[
					'source'=>'auction-detail/list-byauction/'.$id,
					'searchable'=>true,
					'columns'=>[
						[
							'name'=>'id',
							'title'=>'ID',
							'visible'=>false,
						],
						[
							'name'=>'lot_no',
							'title'=>'Lot No',
							'visible'=>true,
							'search'=>[
								'type'=>'text'
							],
						],
						[
							'name'=>'unit.unit_code',
							'title'=>'Unit Code',
							'visible'=>true,
							'search'=>[
								'type'=>'text'
							]
						],
						[
							'name'=>'npl.npl_no',
							'title'=>'NPL No',
							'visible'=>true,
						],
						[
							'name'=>'bidder',
							'title'=>'Bidder',
							'visible'=>true,
							'transform'=>function($e) {
								return $e['first_name'].' '.$e['last_name'];
							}
						],
						[
							'name'=>'limit_price',
							'title'=>'Limit Price',
							'visible'=>true,
						],
						[
							'name'=>'appraisal_price',
							'title'=>'Appraisal Price',
							'visible'=>true,
						],
						[
							'name'=>'fixed_price',
							'title'=>'Fixed Price',
							'visible'=>true,
						],
						[
							'name'=>'status',
							'title'=>'Status',
							'visible'=>true,
							'transform'=>[
								'inactive','active','sold','paid','cancel'
							]
						]
					],
					'bulks'=>[
						'status:0'=>'Inactive',
						'status:1'=>'Active',
						'status:4'=>'Cancel'
					],
					'grid_actions'=>[
						[
							'icon'=>'edit',
							'class'=>'btn-primary',
							'title'=>'Update',
							'url'=>url('auction-detail/update'),
							'allow'=>true
						],
					],
				],
				'action_buttons'=>[
					[
						'icon'=>'plus-circle',
						'class'=>'btn-primary btn-add-unit',
						'title'=>'Add New',
						'url'=>'#',
						'type'=>'link',
						'attributes'=>"data-aid=".$id.""
					],
				],
			]
		];
	}
}
<?php
namespace App\Http\Controllers\Auctions;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\AuctionDetail;
use App\Tools\DataTable;

class AuctionDetailController extends BaseController {
	protected $_baseUrl = 'auction-detail';
	protected $_title = 'Auction Detail';
	protected $_model = AuctionDetail::class;

	public function listByAuction(Request $request, $auctionId) {
		$model = $this->_model::where('auction_id', $auctionId)->get();
		$setting = [
			'table'=>[
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
			]
		];
		return DataTable::build($model, $setting)->make(true);
	}
	
	public function createByAuctionId($auctionId) {
		$data = [
			'action_buttons'=>[
				[
					'icon'=>'x-circle',
					'class'=>'btn-white',
					'title'=>'Cancel',
					'url'=>route('unit.update',['id'=>$auctionId]),
					'type'=>'link',
				],
				[
					'icon'=>'check-circle',
					'class'=>'btn-primary',
					'title'=>'Submit',
					'type'=>'button'
				],
			]
		];
		return view('.create')->with($data);
    }

    protected function setForm() {
        return AuctionDetailForm::class;
    }

    public function createAction(Request $request) {
        $data = $request->all();
        $data['from_time'] = convert_date($data['from_time'], 'Y-m-d H:i:s');
        $data['to_time'] = convert_date($data['to_time'], 'Y-m-d H:i:s');
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
					'page'=>'unit/update/'.$data['unit_id']
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

    public function updateAction(Request $request, $id) {
        $data = $request->all();
        $data['from_time'] = convert_date($data['from_time'], 'Y-m-d H:i:s');
        $data['to_time'] = convert_date($data['to_time'], 'Y-m-d H:i:s');
        
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

		if($this->_model::where('id',$id)->update($data)) {
			$request->session()->flash('status', 'Update was successful!');
			return response()->json([
				'status'=>true,
				'data'=>$data,
				'errors'=>null,
				'redirect'=>[
					'page'=>'unit/update/'.$data['unit_id']
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
	
	public function detail(Request $request, $id) {
		$model = $this->_model::find($id);
		$form = $this->setForm();
		
		$data = [
			'id'=>$id,
			'form' => new $form($model, ['mode'=>'detail']),
			'action_buttons'=> [
				[
					'icon'=>'list',
					'class'=>'btn-dark',
					'title'=>'List',
					'url'=>route('unit.update', ['id'=>$model->unit_id]),
					'type'=>'link',
				],
				[
					'icon'=>'plus-circle',
					'class'=>'btn-success',
					'title'=>'Create',
					'url'=>route($this->_baseUrl.'.create',['auctionId'=>$model->unit_id]),
					'type'=>'link'
				],
				[
					'icon'=>'edit',
					'class'=>'btn-info',
					'title'=>'Update',
					'url'=>route($this->_baseUrl.'.update', ['id'=>$id]),
					'type'=>'link'
				],
			]
		];

		return view($this->_baseView.'.detail')->with($data);
	}
    
    protected function validation() {
        return [
			'unit_id'=>'required',
			'pic_name'=>'required',
			'from_date'=>'required',
			'to_date'=>'required',
            'mobilize_from'=>'required',
            'mobilize_to'=>'required',
            'mobilize_type'=>'required',
		];
    }
}
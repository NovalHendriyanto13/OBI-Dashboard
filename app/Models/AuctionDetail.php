<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuctionDetail extends Model {
	/**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = BaseTable::TBL_AUCTION_DETAIL; 
    /**
	 * The attributes that aren't mass assignable.
	 *
	 * @var array
	 */
	protected $guarded = [];

     public function auction() {
          return $this->belongsTo('App\Models\Auction','auction_id');
     }
}
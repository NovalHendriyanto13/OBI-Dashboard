<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model {
	/**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = BaseTable::TBL_UNIT; 
    /**
	 * The attributes that aren't mass assignable.
	 *
	 * @var array
	 */
	protected $guarded = [];

	public function brand() {
		return $this->hasOne('App\Models\Brand','id','brand_id');
	}

	public function consignor() {
		return $this->hasOne('App\Models\Consignor','id','consignor_id');
	}

	public function area() {
		return $this->hasOne('App\Models\Area','id','area_id');
	}

}
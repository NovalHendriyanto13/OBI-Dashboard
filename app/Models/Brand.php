<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model {
	/**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = BaseTable::TBL_BRAND; 
    /**
	 * The attributes that aren't mass assignable.
	 *
	 * @var array
	 */
	protected $guarded = [];

	public function parent() {
		return $this->belongsTo('App\Models\Brand','parent_id');
	}
}
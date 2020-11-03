<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mobilization extends Model {
	/**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = BaseTable::TBL_MOBILIZATION; 
    /**
	 * The attributes that aren't mass assignable.
	 *
	 * @var array
	 */
    protected $guarded = [];
    
    public function unit() {
		return $this->belongsTo('App\Models\Unit');
	}

}
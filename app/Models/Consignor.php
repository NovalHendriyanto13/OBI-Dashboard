<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Consignor extends Model {
	/**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = BaseTable::TBL_CONSIGNOR; 
    /**
	 * The attributes that aren't mass assignable.
	 *
	 * @var array
	 */
	protected $guarded = [];

}
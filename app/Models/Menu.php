<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model {
	/**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'menus'; 
    /**
	 * The attributes that aren't mass assignable.
	 *
	 * @var array
	 */
	protected $guarded = [];

	public function parent() {
		return $this->belongsTo('App\Models\Menu','parent_id');
	}

	public function module() {
		return $this->hasOne('App\Models\Module','id','module_id');
	}
}
<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class User extends Model {
	/**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users'; 

    /**
	 * The attributes that aren't mass assignable.
	 *
	 * @var array
	 */
	protected $guarded = [];

	/**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'password' => false,
        // 'created_by' => Auth::user()->id
    ];
}
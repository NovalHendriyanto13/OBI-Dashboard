<?php
namespace App\Http\Controllers\Userlist;

use App\Http\Controllers\BaseController;
use App\Models\Npl;

class NplController extends BaseController {
    protected $_baseUrl = 'npl';
	protected $_title = 'NPL';
	protected $_model = Npl::class;
}
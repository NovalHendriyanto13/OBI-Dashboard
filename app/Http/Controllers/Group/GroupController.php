<?php
namespace App\Http\Controllers\Group;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use App\Models\Group;

class GroupController extends BaseController {
	protected $_baseUrl = 'group';
	protected $_title = 'Group';
	protected $_model = Group::class;
}
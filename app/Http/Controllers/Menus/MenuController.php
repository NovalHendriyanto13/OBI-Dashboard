<?php
namespace App\Http\Controllers\Menus;

use App\Http\Controllers\BaseController;
use App\Models\Menu;

class MenuController extends BaseController {
	protected $_baseUrl = 'menu';
	protected $_title = 'Menu';
	protected $_model = Menu::class;
}
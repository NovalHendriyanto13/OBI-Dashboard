<?php
namespace App\Tools;

use Illuminate\Support\Facades\Auth;

class Permission {
	
	protected $_permissionKey = 'group_';

	public static function setPermission(Int $groupId) {
		if ($this->getPermission($this->_permissionKey.$groupId) == '') { 
			$permissions = Permission::join('groups','permission.group_id','=','groups.id')
				->join('modules','permission.module_id','=','modules.id')
				->select('modules.*', 'groups.name AS groupName')
				->where('group_id',$groupId)
				->get();

			$grants = [];
			foreach($permissions as $permission) {
				$grants[$permission->groupName][] = [
					'id'=>$permission->id,
					'name'=>$permission->name,
					'initial'=>$permission->initial,
					'action'=>$permission->action,
				];
			}
			Redis::set($this->_permissionKey.$groupId, json_encode($grants));
		}
	}

	public static function getPermission(String $key) {
		return Redis::get($key);
	}
}
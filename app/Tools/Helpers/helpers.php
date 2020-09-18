<?php

if (! function_exists('variable_get')) {
	function variable_get($k) {
		$variable = new \App\Tools\Variable;
		if ($variable->get($k) == '' ) 
			return null;

		return $variable::get($k);
	}
}

if (! function_exists('is_root')) {
	function is_root() {
		return \App\Tools\Permission::isRoot();
	}
}

if (! function_exists('set_menu')) {
	function set_menu(Int $groupId) {
		$redisKey = \App\Tools\Permission::$_permissionKey.md5($groupId);

		$getRedis = \App\Tools\Redis::get($redisKey);
		if(is_null($getRedis)) {
			// set permission
			\App\Tools\Permission::setPermission($groupId);

			$getRedis = \App\Tools\Redis::get($redisKey);
		}
		$permission = json_decode($getRedis);

		return (Object) $permission->menus;
	}
}
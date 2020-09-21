<?php
$base = [
	'group'=>Authentication\Group\GroupController::class,
	'user'=>Authentication\Users\UserController::class,
	'module'=>Authentication\Module\ModuleController::class,
	'menu'=>Authentication\Menus\MenuController::class,
	'permission'=>Authentication\Permission\PermissionController::class,
	'area'=>Masters\Master\AreaController::class,
];

foreach($base as $prefix=>$c) {
	Route::prefix($prefix)->group(function() use ($prefix, $c) {
		Route::get('/',['as'=>$prefix.'.index','uses'=>$c.'@index']);
		Route::get('create',['as'=>$prefix.'.create','uses'=>$c.'@create']);
		Route::post('create',['as'=>$prefix.'.create','uses'=>$c.'@createAction']);
		Route::get('update/{id}',['as'=>$prefix.'.update','uses'=>$c.'@update']);
		Route::put('update/{id}',['as'=>$prefix.'.update','uses'=>$c.'@updateAction']);
	});
}

// other route
Route::get('module/get-action/{name}', ['as'=>'module.getAction','uses'=>'Authentication\Module\ModuleController@getAction']);

Route::prefix('setting')->group(function() {
	Route::get('clear',['as'=>'setting.clear','uses'=>'Setting\Setting\SettingController@clear']);
});
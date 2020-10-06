<?php
$base = [
	'group'=>Authentication\GroupController::class,
	'user'=>Authentication\UserController::class,
	'module'=>Authentication\ModuleController::class,
	'menu'=>Authentication\MenuController::class,
	'permission'=>Authentication\PermissionController::class,
	'area'=>Masters\AreaController::class,
	'brand'=>Masters\BrandController::class,
	'consignor'=>Masters\ConsignorController::class,
	'unit'=>Masters\UnitController::class,
];

foreach($base as $prefix=>$c) {
	Route::prefix($prefix)->group(function() use ($prefix, $c) {
		Route::get('/',['as'=>$prefix.'.index','uses'=>$c.'@index']);
		Route::get('create',['as'=>$prefix.'.create','uses'=>$c.'@create']);
		Route::post('create',['as'=>$prefix.'.create','uses'=>$c.'@createAction']);
		Route::get('update/{id}',['as'=>$prefix.'.update','uses'=>$c.'@update']);
		Route::match(['post','put'],'update/{id}',['as'=>$prefix.'.update','uses'=>$c.'@updateAction']);
	});
}

// other route
Route::get('module/get-action/{name}', ['as'=>'module.getAction','uses'=>'Authentication\ModuleController@getAction']);

Route::prefix('setting')->group(function() {
	Route::get('clear',['as'=>'setting.clear','uses'=>'Setting\SettingController@clear']);
});
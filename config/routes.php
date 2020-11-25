<?php
$base = [
	'group'=>Authentication\GroupController::class,
	'user'=>Authentication\UserController::class,
	'module'=>Authentication\ModuleController::class,
	'menu'=>Authentication\MenuController::class,
	'permission'=>Authentication\PermissionController::class,
	'area'=>Masters\AreaController::class,
	'brand'=>Masters\BrandController::class,
	'unit'=>Masters\UnitController::class,
	'gallery'=>Masters\GalleryController::class,
	'mobilization'=>Masters\MobilizationController::class,
	'bidder'=>Userlist\BidderController::class,
	'consignor'=>Userlist\ConsignorController::class,
	'auction'=>Auctions\AuctionController::class,
];

foreach($base as $prefix=>$c) {
	Route::prefix($prefix)->group(function() use ($prefix, $c) {
		Route::get('/',['as'=>$prefix.'.index','uses'=>$c.'@index']);
		Route::get('create',['as'=>$prefix.'.create','uses'=>$c.'@create']);
		Route::post('create',['as'=>$prefix.'.create','uses'=>$c.'@createAction']);
		Route::get('update/{id}',['as'=>$prefix.'.update','uses'=>$c.'@update']);
		Route::match(['post','put'],'update/{id}',['as'=>$prefix.'.update','uses'=>$c.'@updateAction']);
		Route::get('detail/{id}',['as'=>$prefix.'.detail','uses'=>$c.'@detail']);
		Route::get('data-list',['as'=>$prefix.'.datalist','uses'=>$c.'@dataList']);
	});
}

// other route

// module
Route::get('module/get-action/{name}', ['as'=>'module.getAction','uses'=>'Authentication\ModuleController@getAction']);
// setting
Route::prefix('setting')->group(function() {
	Route::get('clear',['as'=>'setting.clear','uses'=>'Setting\SettingController@clear']);
});
// gallery
Route::post('gallery/remove-file',['as'=>'gallery.remove','uses'=>'Masters\GalleryController@remove']);
// mobilization
Route::get('mobilization/create/{unitId}',['as'=>'mobilization.create','uses'=>'Masters\MobilizationController@createByUnitId']);
Route::get('mobilization/list-byunit/{unitId}',['as'=>'mobilization.listbyunit','uses'=>'Masters\MobilizationController@listByUnit']);
// user
Route::get('user/get-name',['as'=>'user.get_name','uses'=>'Authentication\UserController@getName']);
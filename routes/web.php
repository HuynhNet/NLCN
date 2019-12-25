<?php


// trang chu
Route::get('index', [
	'as' => 'getIndex',
	'uses' => 'indexController@getIndex'
]);


// login
Route::get('login', [
	'as' => 'getLogin',
	'uses' => 'adminController@getLogin'
]);

Route::post('login', [
	'as' => 'postLogin',
	'uses' => 'adminController@postLogin'
]);

// reset captcha image
Route::get('refreshcaptcha', [
	'as' => 'getRefreshcapcha',
	'uses' => 'adminController@refreshCaptcha'
]);

// reset password
Route::get('forget-password', [
	'as' => 'getForgetPassword',
	'uses' => 'Auth\ForgotPasswordController@showLinkRequestForm'
]);

Route::post('forget-password', [
	'as' => 'postForgetPassword',
	'uses' => 'Auth\ForgotPasswordController@sendResetLinkEmail'
]);

Route::get('reset-password/{token}', [
	'as' => 'password.reset',
	'uses' => 'Auth\ResetPasswordController@showResetForm'
]);

Route::post('reset-password', [
	'as' => 'postResetPassword',
	'uses' => 'Auth\ResetPasswordController@reset'
]);

// logout
Route::get('logout', [
	'as' => 'getLogout',
	'uses' => 'adminController@getLogout'
]);


// register
Route::get('register', [
	'as' => 'getRegister',
	'uses' => 'indexController@getRegister'
]);

Route::post('register', [
	'as' => 'postRegister',
	'uses' => 'indexController@postRegister'
]);

// manage cart
Route::get('add-cart/{id}', [
	'as' => 'getAddCart',
	'uses' => 'indexController@getAddCart'
]);

Route::get('cart', [
	'as' => 'getCart',
	'uses' => 'indexController@getCart'
]);

Route::get('buy-now/{id}', [
	'as' => 'getBuyNow',
	'uses' => 'indexController@getBuyNow'
]);

Route::get('update-cart', [
	'as' => 'getUpdateCart',
	'uses' => 'indexController@getUpdateCart'
]);

Route::get('delete-cart/{id}', [
	'as' => 'getDeleteCart',
	'uses' => 'indexController@getDeleteCart'
]);

Route::get('Order',[
	'as' => 'getCheckout',
	'uses' => 'indexController@getCheckout'
]);
Route::post('Order', [
	'as' => 'postCheckout',
	'uses' => 'indexController@postCheckout'
]);

// product
Route::get('view-product/{id}', [
	'as' => 'getViewProduct',
	'uses' => 'indexController@getViewProduct'
]);

Route::get('view-all/{loai}', [
	'as' => 'getViewAll',
	'uses' => 'indexController@getViewAll'
]);

Route::get('view-all-firm/{loai}/{hang}', [
	'as' => 'getViewAllByFirm',
	'uses' => 'indexController@getViewAllByFirm'
]);

// view firm checkbox
Route::post('view-all-firm-check', [
	'as' => 'getViewAllByFirmCheckbox',
	'uses' => 'indexController@getViewAllByFirmCheckbox'
]);

// search product
Route::get('search', [
	'as' => 'getSearch',
	'uses' => 'indexController@getSearch'
]);

Route::get('view-all-search', [
	'as' => 'getViewAllSearch',
	'uses' => 'indexController@getViewAllSearch'
]);

Route::get('infomation_memeber/{id}', [
	'as' => 'getInfoMember',
	'uses' => 'indexController@getInfoMember'
]);

Route::group(['prefix'=>'admin'], function(){

	Route::get('/', [
		'as' => 'getAdmin',
		'uses' => 'adminController@getAdmin'
	]);

	// manage admin
	Route::get('manage-admin', [
		'as' => 'getManageAdmin',
		'uses' => 'adminController@getManageAdmin'
	]);

	Route::get('add-admin', [
		'as' => 'getAddAdmin',
		'uses' => 'adminController@getAddAdmin'
	]);

	Route::post('add-admin', [
		'as' => 'postAddAdmin',
		'uses' => 'adminController@postAddAdmin'
	]);

	Route::get('infomation-admin/{id}', [
		'as' => 'getInforUser',
		'uses' => 'adminController@getInforUser'
	]);

	Route::get('search-admin', [
		'as' => 'getSearchAdmin',
		'uses' => 'adminController@getSearchAdmin'
	]);

	// manage member
	Route::get('manage-member', [
		'as' => 'getManageMember',
		'uses' => 'adminController@getManageMember'
	]);

	Route::get('delete-member/{id}', [
		'as' => 'getDeleteMember',
		'uses' => 'adminController@getDeleteMember'
	]);

	Route::get('delete-all-member', [
		'as' => 'getDeleteAllMember',
		'uses' => 'adminController@getDeleteAllMember'
	]);

	Route::get('search-member', [
		'as' => 'getSearchMember',
		'uses' => 'adminController@getSearchMember'
	]);

	// import user from excel file
	Route::get('export',[
		'as' => 'getExport',
		'uses' => 'adminController@getExport'
	]);

	Route::get('importExportView', [
		'as' => 'getimportExportView',
		'uses' => 'adminController@importExportView'
	]);

	Route::post('import',[
		'as' => 'postImport',
		'uses' => 'adminController@postImport'
	]);

	// manage product
	Route::get('manage-products', [
		'as' => 'getManageProducts',
		'uses' => 'adminController@getManageProducts'

	]);

	Route::get('manage-products/add-product', [
		'as' => 'getAddProduct',
		'uses' => 'adminController@getAddProduct'
	]);

	Route::post('manage-products/add-product', [
		'as' => 'postAddProduct',
		'uses' => 'adminController@postAddProduct'
	]);

	Route::get('import-product-view',[
		'as' => 'getViewImportProduct',
		'uses' => 'adminController@getViewImportProduct'
	]);

	Route::post('import-product',[
		'as' => 'getImportProduct',
		'uses' => 'adminController@getImportProduct'
	]);

	Route::get('export-product',[
		'as' => 'getExportProduct',
		'uses' => 'adminController@getExportProduct'
	]);

	Route::get('search-product', [
		'as' => 'getSearchProduct',
		'uses' => 'adminController@getSearchProduct'
	]);

	// manage order
	Route::get('manage-order',[
		'as' => 'getManageOrder',
		'uses' => 'adminController@getManageOrder'
	]);

	Route::get('search-order', [
		'as' => 'getSearchOrder',
		'uses' => 'adminController@getSearchOrder'
	]);

	Route::get('order-detail/{id}', [
		'as' => 'getOrderDetail',
		'uses' => 'adminController@getOrderDetail'
	]);

	// manage banner
	Route::get('manage-banner', [
		'as' => 'getManageBanner',
		'uses' => 'adminController@getManageBanner'
	]);

	Route::post('add-banner', [
		'as' => 'getAddBanner',
		'uses' => 'adminController@getAddBanner'
	]);

	Route::get('delete-all-banner', [
		'as' => 'getDeleteAllBanner',
		'uses' => 'adminController@getDeleteAllBanner'
	]);

	Route::get('search-banner', [
		'as' => 'getSearchBanner',
		'uses' => 'adminController@getSearchBanner'
	]);

});



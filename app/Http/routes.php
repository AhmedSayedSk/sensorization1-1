<?php

Route::get('test', function(){
	$x = Cart::get(78);
	dd($x);
});

// Auth routes
Route::group(['prefix' => '/', 'namespace' => 'Auth'], function() {
	Route::get('login', 'AuthController@getLogin');
	Route::post('login', 'AuthController@postLogin');
	Route::get('logout', 'AuthController@getLogout');
	Route::get('register', 'AuthController@getRegister');
	Route::post('register', 'AuthController@postRegister');
});


/**** BACKEND ****/

	// Localization (lang)
	Route::get('/locale/{locale?}', ['as' => 'set-locale', 'uses' => 'appController@setLocale']);

	// Super admin & admins routes
	Route::group(['middleware' => 'authenticated:super_admin,admin', 'prefix' => 'admin', 'namespace' => 'Admin'], function() {
		Route::group(['prefix' => 'products', 'namespace' => 'Products'], function(){

			Route::controller('search', 'searchController');

			Route::group(['prefix' => 'categories'], function(){
				Route::post('/get-data-by-method1', 'categoriesController@postGetDataByMethod1');
				Route::resource('/', 'categoriesController', ['parameters' => ['' => 'id']]);
			});

			Route::group(['prefix' => 'carousel'], function(){
				Route::resource('/', 'carouselController');
				Route::post('/live-status', 'carouselController@liveStatus');
			});

			Route::group(['prefix' => 'tags'], function(){
				Route::post('view-by-keyword', 'tagsController@viewByKeyword');
				Route::post('view-append-modal', ['as' => 'APT.view-append-modal', 'uses' => 'tagsController@viewAppendModal']);
				Route::resource('/', 'tagsController', ['parameters' => ['' => 'id']]);
			});

			Route::resource('/', 'productsController', ['parameters' => ['' => 'id']]);
			Route::get('create/step/{step_id}', 'productsController@create');
			Route::post('store/step/{step_id}', 'productsController@store')->where('step_id', '[0-9]+');
			Route::post('/live-status', 'productsController@liveStatus');
			Route::post('/is-new-status', 'productsController@isNewStatus');
		});

		Route::group(['namespace' => 'Clients', 'prefix' => 'clients'], function(){
			Route::resource('admins/accounts', 'normalAdminsController', ['parameters' => ['' => 'id']]);
			Route::resource('users/accounts', 'usersController', ['parameters' => ['' => 'id']]);
		});

		Route::group(['prefix' => 'review-cart'], function(){
			Route::resource('/', "reviewCartController", ['only' => ['store', 'destroy'], 'parameters' => ['' => 'id']]);
			Route::get('pending-requests', "reviewCartController@getPendingRequests");
			Route::get('accepted-requests', "reviewCartController@getAcceptedRequests");
		});

		Route::controller('/', 'superAdminController', ['parameters' => ['' => 'id']]);
		Route::controller('/', 'mainController', ['parameters' => ['' => 'id']]);
	});

	// Uploads CRUD routes
	Route::group(['namespace' => 'Uploads'], function(){
		Route::group(['prefix' => 'image'], function(){
			Route::post('upload', ['as' => 'image-upload', 'uses' => 'ImageController@upload']);
			Route::post('delete', ['as' => 'image-remove', 'uses' => 'ImageController@delete']);
		});
		Route::group(['prefix' => 'carousel'], function(){
			Route::post('upload', ['as' => 'carousel-upload', 'uses' => 'CarouselController@upload']);
			Route::post('delete', ['as' => 'carousel-remove', 'uses' => 'CarouselController@delete']);
		});
	});

/*****************/


/*** FRONTEND ****/

	// User profile routes
	Route::group(['prefix' => 'profile', 'namespace' => 'User'], function(){
		Route::controller('/', 'profileController');
	});

	// Products routes
	Route::group(['namespace' => 'User'], function() {
		Route::group(['prefix' => 'products', 'namespace' => 'Products'], function() {
			Route::controller('search', 'searchController');
			Route::get('category/{category_code}/{category_name}', 'searchController@byCategoryName');

			Route::get('/', 'productsController@getAll');
			Route::get('{serial_number}/{name?}', 'productsController@getProductName');
		});
	});

	// Cart routes
	Route::controller('/my-cart', 'User\cartController');

	// Payment routes
	Route::group(['middleware' => 'auth', 'namespace' => 'Payment'], function() {
		Route::controller("/paypal-payment", 'paypalController');
		Route::controller('/on-delivery-payment', 'onDeliveryContoller');
	});

	// Interface user pages
	Route::controller('/', "User\indexController");

/****************/

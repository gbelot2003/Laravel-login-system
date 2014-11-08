<?php


/**** Global Routes ****/

Route::get('/', array(
	'as' => 'home',
	'uses' => 'HomeController@home'
));

/***User Profife***/
Route::get('/user/{username}', array(
	'as' => 'profile-user',
	'uses' => 'profileController@user'
));

/**Article pages**/
Route::get('/article/{articleId}', array(
	'as' => 'article-post',
	'uses' => 'ArticleController@articlePost'
));

/* Sections*/
Route::get('/sections/{sectionsId}', array(
	'as' 	=> 'section-post',
	'uses' 	=> 'SectionsController@sectionsPost'
));


/************************* Authenticade Grup ****************************/

Route::group(array('before' => 'auth'), function(){

	/***** CSRF protection group *****/
	Route::group(array('before' => 'csrf'), function(){

		/* Change pasword POST*/
		Route::post('/account/change-password', array(
			'as' 	=> "account-change-password-post",
			'uses' 	=> "AccountController@postChangePassword"
		));

	});

	/* SignIn Post */
	Route::get('/account/sign-out', array(
		'as' 	=> 'account-sign-out',
		'uses' 	=> 'AccountController@getSignOut'
	));


	/* Change pasword GET*/
	Route::get('/account/change-password', array(
		'as' 	=> "account-change-password",
		'uses' 	=> "AccountController@getChangePassword"
	));

});

/**************** Unauthenticade Grupe ****************/
Route::group(array('before' => 'guest'), function(){

	/*CSRF protection*/
	Route::group(array('before' => 'csrf'), function(){

		/*Create accounte  create Accounte (POST) */
		Route::post('/account/create', array(
			'as' 	=> 'account-create-post',
			'uses' 	=> 'AccountController@postCreate'
		));

		/* SignIn Post */
		Route::post('account/signin', array(
			'as' 	=> 'account-sign-in-post',
			'uses' 	=> 'AccountController@postSignIn'
		));

		/*Forgotte Password POST*/
		Route::post('/account/forgot-password', array(
			'as' 	=> 'account-forgot-password-post',
			'uses' 	=> 'AccountController@postForgotPassword'
		));
	});

	/*Create Accounte (GET) */
	Route::get('/account/create', array(
		'as' 	=> 'account-create',
		'uses' 	=> 'AccountController@getCreate'
	));

	/*Active Code */
	Route::get('/account/activate/{code}', array(
		'as' 	=> 'account-activate',
		'uses' 	=> 'AccountController@getActivate'
	));

	/*Sign In */
	Route::get('/account/signin', array(
		'as' 	=> 'account-sign-in',
		'uses' 	=> 'AccountController@getSignIn'
	));

	/*Forgotte Password GET*/
	Route::get('/account/forgot-password', array(
		'as' => 'account-forgot-password',
		'uses' => 'AccountController@getForgotPassword'
	));

	/*New Password*/
	Route::get('/account/recover/{code}', array(
		'as' 	=> 'account-recover',
		'uses' 	=> 'AccountController@getRecover'
	));

});
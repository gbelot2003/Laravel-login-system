<?php

class AccountController extends BaseController{

	public function getCreate(){
		return View::make('account.create');
	}

	public function postCreate(){
		$varlidator = Validator::make(Input::all(),
			array( 
				'email' 			=> 'required | max:50 | email| unique:users',
				'username' 			=> 'required | max:20 | min:3 | unique:users',
				'password' 			=> 'required | min:6',
				'password_again' 	=> 'required | same:password'

			)
		);

		if($validator->fails()){
			return Redirect::route('account-create')
					->withErrors($validator)
					->withInput();
		} else {
			$email 		= Input::get('email');
			$username 	= Input::get('username');
			$password 	= Input::get('password');

			// Activation Code
			$code 		= str_random(60);

			$user = Users::create(array(
				'email' => $email,
				'username' => $username,
				'password' => Hash::make($password),
				'code' => $code,
				'active' => 0
			));

			if($user){
				Mail::send('emails.auth.activate', array('link' => URL::route('account-activate', $code), 'username' => $username), function($message) use ($user){
					$message->to($user->email, $user->username)->subject('activate your account');
				});

				return Redirect::route('home')
						->with('global', 'Your account has been craeated! We have send you an email');
			}
		}
	}

	public function getActivate($code){
		$user = Users::where('code', '=', $code)->where('active', '=', 0);
		if($user->count()):

			$user = $user->first();
			
			//Update active state
			$user->active = 1;
			$user->code = '';

			if($user->save()){
				return Redirect::route('home')
						->with('global', 'Activated! You can now Sign in!!');
			}

			return Redirect::route('home')
					->with('global', 'We Could not active your account. Try again later');

		endif;
	}

	public function getSignIn(){
		return View::make("account.signin");
	}


	public function getSignOut(){
		Auth::logout();
		return Redirect::route('home');
	}

	public function postSignIn(){
		$validator = Validator::make(Input::all(),
			array(
				"email" 		=> "required | email",
				"password" 		=> "required"
			)
		);

		if($validator->fails()) {
			return Redirect::route('account-sign-in')
				->withErrors($validator)
				->withInput();
		} else {	

			$remember = (Input::has('remember')) ? true : false;

			$auth = Auth::attempt(array(
				'email' 		=> Input::get('email'),
				'password' 		=> Input::get('password'),
				'active'		=> 1
			), $remember);

			if($auth){
				return Redirect::intended('/');
			} else {
				return Redirect::route('account-sign-in')
						->with('global', 'Email/Password wrong, or account not activated');
			}
		}

		return Redirect::route('account-sign-in')
				->with('global', 'There was a problem  sign in you in, Have you activated?');
	}


	public function getChangePassword(){
		return View::make('account.password');
	}

	public function postChangePassword(){
		$validator = Validator::make(Input::all(), 
			array(
				'old_password' 		=> 'required',
				'password' 			=> 'required | min:6',
				'password_again'	=> 'required | same:password'
			)
		);

		if($validator->fails()){
			// Redirect
			return Redirect::route('account-change-password')
					->withErrors($validator);

		} else {
			// Changes Password
			$user = Users::find(Auth::user()->id);
			$uOld_password = $user->password;

			$old_password = Input::get('old_password');
			$password = Input::get('password');

			if(Hash::check($old_password, $uOld_password)){
				$user->password = Hash::make($password);
				if($user->save()){
					return Redirect::route('home')
							->with('global', 'Your Password has been Changes');
				} else {
						return Redirect::route('account-change-password')
								->with('global', 'Your Old password is incorrect');	
				}
			}

		}
		// FauldsBack
		return Redirect::route('account-change-password')
				->with('global', 'Somethin went wrong with password Changes, try again');

	}


	public function getForgotPassword(){
		return View::make('account.forgot');
	}

	public function postForgotPassword(){
		$validator = Validator::make(Input::all(),
			array(
				'email' => "required | email"
			)
		);
		if($validator->fails()){
			return Redirect::route('account-forgot-password')
					->withErrors($validator)
					->withInput();
		}else{
			$user = Users::where('email', '=', Input::get('email'));

			if($user->count()){
				$user 					= $user->first();
				$code 					= str_random(60);
				$password 				= str_random(10);
				$user->code 			= $code;
				$user->password_temp 	= Hash::make($password);

				if($user->save()){
					Mail::send('emails.auth.forgot', array(
						'url' 			=> URL::route('account-recover', $code),
						'username'		=> $user->username,
						'password'		=> $password
					), function($message) use ($user){
						$message->to($user->email, $user->username)->subject('Your New Password');
					});

					return Redirect::route('home')
							->with('global', 'We have Send you a new password by email.');
				}

			}
		}

		return Redirect::route('account-forgot-password')
				->with('global', 'Could not request new password.'); 
	}


	public function getRecover($code){
		$user = Users::where('code', '=', $code)
			->where('password_temp', '!=', '');

		if($user->count()){
			$user =  $user->first();

			$user->password = $user->password_temp;
			$user->password_temp = '';
			$user->code = '';
			if($user->save()){
				return Redirect::route('home')
						->with('global', 'Your account has beeen revocered and you can sign in with your new password.');
			}

		}
		
		// FoulBack
		return Redirect::route('home')
				->with('global', 'Could not revover your account.');


	}
}
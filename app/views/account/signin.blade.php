@extends('layout.main')

@section('content')
	<form action="{{ URL::route('account-sign-in-post') }}" method="post">

		<div class="fields">
			Email: <input type="text" name="email" {{ (Input::old('username')) ?' value="'. e(Input::old('username')) .'"' : '' }}>
			@if($errors->has('email'))
				{{$errors->first('email')}}
			@endif
		</div>

		<div class="fields">
			Password: <input type="password" name="password">
			@if($errors->has('password'))
				{{$errors->first('password')}}
			@endif
		</div>

		<div class="fields">
			<input type="checkbox" name="remember" id="remember">
			<label for="remember">
				Remember me
			</label>	
		</div>
		<input type="submit" value="Sign In">
		{{ Form::token() }}
	</form>
@stop
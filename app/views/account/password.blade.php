@extends ('layout.main')

@section('content')
	<form action="{{ URL::route('account-change-password-post') }}" method="post">

		<div class="field">
			<label>Old Password</label>
			<input type="password" name="old_password" {{ (Input::old('old_password')) ?' value="'. e(Input::old('old_password')) .'"' : '' }}>
			@if($errors->has('old_password'))
				{{$errors->first('old_password')}}
			@endif
		</div>

		<div class="field">
			<label>New Password</label>
			<input type="password" name="password" {{ (Input::old('password')) ?' value="'. e(Input::old('password')) .'"' : '' }}>
			@if($errors->has('password'))
				{{$errors->first('password')}}
			@endif
		</div>

		<div class="field">
			<label>New Password again</label>
			<input type="password" name="password_again" {{ (Input::old('password_again')) ?' value="'. e(Input::old('password_again')) .'"' : '' }}>
			@if($errors->has('password_again'))
				{{$errors->first('password_again')}}
			@endif
		</div>

		<input type="submit" value="Change Password">
		{{ Form::token() }}
	</form>
@stop
	@if(Auth::check())
		<div class="username">Hello <a href="{{URL::route('profile-user', Auth::user()->username) }}">{{ Auth::user()->username }}</a></div></div>		
	@endif
	<hr />
	@if(Auth::check())
	<div class="username">Hello {{ Auth::user()->username }}</div>		
	@endif
	<hr />
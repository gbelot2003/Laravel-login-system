<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Laravel PHP Framework</title>
	@include('layout.header')
</head>
<body>
	<header>
		<div class="row">
			<h1>Test Site</h1>
		</div>
	</header>
	<section>
		<div class="row">
			@include('layout.navigation')
			<div id="main" class="l-main">
				@if(Session::has('global'))
					<p>{{ Session::get('global') }}</p>
				@endif
				@include('layout.user_check')
				@yield('content')
			</div>
		</div>
	</section>

	<footer>
		
	</footer>
</body>
	<script>$(document).foundation();</script>
</html>

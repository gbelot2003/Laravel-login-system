@extends('layout.profile')

@section('content')
	<div class="row">
		<div class=" panel small-6 large-4 columns"><span class="small-12">User Name</span> <h5>{{ $user->username }}</h5></div>
		<div class="panel small-6 large-4 columns"><span class="small-12">First Name</span><h5>{{ $user->profiles->first_name }}</h5></div>
		<div class="panel small-6 large-4 columns"><span class="small-12">Last Name</span><h5>{{ $user->profiles->last_name }}</h5></div>
	</div> 
	<div class="row">
		<div class="panel small-12 columns">
			{{ $user->profiles->sign }}
		</div>
	</div>
	<hr />
@stop
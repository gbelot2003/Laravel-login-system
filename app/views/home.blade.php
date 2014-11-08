@extends('layout.main')

@section('content')
	@if(Auth::check())
		Hello {{ Auth::user()->username }}
	@else
		<p>Your not sign in</p>
	@endif
@stop
@extends('layout.main')

@section('content')
	@if(Auth::check())
		Hello {{ Auth::user()->username }}
	@else
		<p>Test</p>
	@endif
	<hr />
@foreach ($articles as $article) 
<h1>{{ e($article->title) }}  <small>posted by {{ $article->user->username }}</small></h1>	
<p>{{ e(Str::limit($article->body, 250)) }}</p>

<hr />
@endforeach
@stop
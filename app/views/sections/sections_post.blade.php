@extends('layout.main')
@section('content')
	<h2>{{$sections->name}}</h2>
	<hr />
	@foreach ($sections->articles as $article) 
	<h3 class="title"><a href="{{URL::route('article-post', $article->id)}}">{{ e($article->title) }}</a>
		<small>posted by <a href="{{URL::route('profile-user', $article->user->username)}}">{{ e($article->user->username) }}</a></small>
	</h3>	
	<p>{{ e(Str::limit($article->body, 250)) }}</p>
	<span><small><a href="{{URL::route('section-post', $article->sections->id)}}">{{ e($article->sections->name)}}</a></small> </span>
	<hr />
	@endforeach
@stop
@extends('layout.main')
@section('content')
	<h2>{{$article->title}}<small> posted by <a href="{{URL::route('profile-user', $article->user->username)}}">{{ $article->user->username }}</a></small></h2>
	<span><small><a href="{{URL::route('section-post', $article->sections->id)}}">{{ e($article->sections->name)}}</a></small> </span>
	<hr />
	<div class="content">{{$article->body}}</div>
@stop
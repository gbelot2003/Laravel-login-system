@extends('layout.main')

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
	@foreach($user->articles as $article)
		<h4><a href="{{URL::route('article-post', $article->id)}}">{{ e($article->title) }}</a></h4>
		<p>{{ e(Str::limit($article->body, 150)) }}</p>
		<span><small><a href="{{URL::route('section-post', $article->sections->id)}}">{{ e($article->sections->name)}}</a></small> </span>
		<hr />
	@endforeach
@stop
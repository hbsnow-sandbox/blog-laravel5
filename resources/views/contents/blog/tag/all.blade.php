@extends('contents.master')

@section('breadcrumb')
	<nav id="breadcrumb">
		<div class="container">
			<div itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
				<a href="http://4uing.net/blog" itemprop="url">
					<span itemprop="title">Blog</span>
				</a>
			</div>
		</div>
	</nav>
@stop

@section('content')
	@if($tags->isEmpty())
	<p>タグが投稿されていません。</p>
	@else
	<ul id="tag-list" class="layout horizontal wrap">
		@foreach($tags as $tag)
		<li class="flex-none">
			<a class="button" ui-sref="blog-tag({slug: '{{ $tag->slug }}'})">{{ $tag->name }}</a>
		</li>
		@endforeach
	</ul>
	@endif
@stop

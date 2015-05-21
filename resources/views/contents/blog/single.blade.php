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

@section('meta')
	<div id="content-header-meta">
		<div class="container">
			<div id="article-date">
				<div id="article-date-created"><time>{{ $created_at->format('Y-m-d') }}</time>
				</div>@if ($updated_at !== null)
<hr><div id="article-date-updated"><time>{{ $updated_at->format('Y-m-d') }}</time>
				</div>
				@endif
			</div>

			<div id="article-tags">
				<ul>
				@foreach ($article->tags as $tag)
<li><a ui-sref="blog-tag({slug: '{{ $tag->slug }}'})" class="button">{{ $tag->name }}</a></li>@endforeach
				</ul>
			</div>

			<div id="article-toc">
				{!! $html_menu !!}
			</div>
		</div>
	</div>
@stop

@section('content')
	{!! $html_content !!}
@stop

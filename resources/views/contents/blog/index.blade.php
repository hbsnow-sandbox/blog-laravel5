@extends('contents.master')

@section('nav')
	<nav id="content-nav">
		<div class="container">
			<div class="layout horizontal center-center">
				<div class="flex-none">
					<a class="button" ui-sref="blog-archives({slug: 'all'})">Archives</a>
				</div>
				<div class="flex-none">
					<a class="button" ui-sref="blog-tag({slug: 'all'})">Tag</a>
				</div>
			</div>
		</div>
	</nav>
@stop

@section('content')
	<p>全投稿{{ $count }}件中のうち、最近投稿された10件の記事を表示しています。すべての投稿は<a ui-sref="blog-archives({slug: 'all'})">Archives</a>で確認することができます。</p>

	@include('contents.blog.list')
@stop

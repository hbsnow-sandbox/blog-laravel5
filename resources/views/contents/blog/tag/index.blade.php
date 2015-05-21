@extends('contents.master')

@section('breadcrumb')
	<nav id="breadcrumb">
		<div class="container">
			<div itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
				<a href="{{ url('/') }}/blog" itemprop="url">
					<span itemprop="title">Blog</span>
				</a>

				<div itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
					<a href="{{ url('/') }}/blog/tag/all" itemprop="url">
						<span itemprop="title">Tag</span>
					</a>
				</div>
			</div>
		</div>
	</nav>
@stop

@section('content')
	<p>{{ $title }}に登録された全{{ $count }}件の記事を表示しています。</p>

	@include('contents.blog.list')
@stop

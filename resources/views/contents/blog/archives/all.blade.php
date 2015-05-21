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
	@include('contents.blog.list')
@stop

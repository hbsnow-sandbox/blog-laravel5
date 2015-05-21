@extends('admin.contents.master')

@section('content')
<ol class="breadcrumb">
	<li><a href="{{ route('admin.index') }}"><span class="glyphicon glyphicon-home"></span></a></li>
	<li class="active">投稿管理</li>
</ol>

@if (Session::has('success'))
<div class="alert alert-success" role="alert">
	<p>{{ Session::get('success') }}</p>
</div>
@endif

@if (Session::get('error') !== '' && Session::has('error'))
<div class="alert alert-danger" role="alert">
	<p>{{ Session::get('error') }}</p>
</div>
@endif

<section>
	<h2 class="page-header">投稿管理</h2>

	@if(!isset($articles) || $articles->isEmpty())
	<div class="alert alert-warning" role="alert">
		<p>投稿がありません。<a href="{{ route('admin.blog.article.create') }}">新規投稿</a>から記事を投稿してください。</p>
	</div>
	@else
	<div class="panel panel-default">
		<div class="panel-heading">投稿一覧</div>

		<table class="table">
			<thead>
				<tr>
					<th class="col-md-1">ID</th>
					<th class="col-md-1">アイコン</th>
					<th class="col-md-4">タイトル</th>
					<th class="col-md-2">スラッグ</th>
					<th class="col-md-3">タグ</th>
					<th class="col-md-1">状態</th>
				</tr>
			</thead>
			<tbody>
				@foreach($articles as $article)
				<tr>
					<td>{{ $article->id }}</td>
					<td>{{ $article->icon->name }}</td>
					<td><a href="{{ route('admin.blog.article.edit', $article->id) }}">{{ $article->title }}</a></td>
					<td>{{ $article->slug }}</td>
					<td>
						@if($article->tags->isEmpty())
						@elseif(count($article->tags) === 1)
							{{ $article->tags->first()->name }}
						@else
							@foreach($article->tags as $index => $tag)
								{{ $tag->name . ($index + 1 === count($article->tags) ? '' : ',') }}
							@endforeach
						@endif
					</td>
					<td>{{ $article->state }}</td>
				</tr>
				@endforeach
			</tbody>
		</table>

	</div>
	@endif
</section>
@stop

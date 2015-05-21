@extends('admin.master')

@section('main')
<div class="row">
	<div class="col-md-2">
		<div class="panel panel-default">
			<div class="panel-heading">ブログ</div>

			<div class="list-group">
				<a href="{{ route('admin.blog.article.create') }}" class="list-group-item">新規投稿</a>
				<a href="{{ route('admin.blog.article.index') }}" class="list-group-item">投稿管理</a>
				<a href="{{ route('admin.blog.tag.index') }}" class="list-group-item">タグ管理</a>
				<a href="{{ route('admin.blog.icon.index') }}" class="list-group-item">アイコン管理</a>
			</div>
		</div>

	</div>

	<div class="col-md-10">
		@yield('content')
	</div>
</div>
@stop
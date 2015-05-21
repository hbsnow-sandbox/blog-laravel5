@extends('admin.contents.master')

@section('content')
<ol class="breadcrumb">
	<li><a href="{{ route('admin.index') }}"><span class="glyphicon glyphicon-home"></span></a></li>
	<li><a href="{{ route('admin.blog.article.index') }}">投稿管理</a></li>
	<li class="active">新規投稿</li>
</ol>

@if (Session::has('errors'))
<div class="alert alert-danger" role="alert">
	@foreach ($errors->all() as $error)
	<p>{{ $error }}</p>
	@endforeach
</div>
@endif

<section>
	<h2 class="page-header">新規投稿</h2>

	@if ($icons->isEmpty() || $tags->isEmpty())
	<div class="alert alert-warning" role="alert">
		@if ($icons->isEmpty())
		<p>アイコンが登録されていません、記事にはアイコンの指定が必須です。アイコンの追加は<a href="{{ route('admin.blog.icon.index') }}">アイコン管理</a>で行ってください。</p>
		@endif

		@if ($icons->isEmpty())
		<p>タグが登録されていません、記事にはタグの指定が必須です。タグの追加は<a href="{{ route('admin.blog.tag.index') }}">タグ管理</a>で行ってください。</p>
		@endif
	</div>
	@else
	{!! Form::open(['route' => 'admin.blog.article.index', 'role' => 'form']) !!}
	<fieldset class="row">
		<div class="col-sm-9">
			<div class="form-group form-group-sm">
				<div class="form-inline">
					{{ url('/') }}/blog/{!! Form::text('slug', $value = Input::old('slug', ''), $attributes = array('class' => 'form-control', 'required' => '')) !!}
				</div>
			</div>

			<div class="panel panel-default">
				<div class="panel-heading">記事</div>

				<div class="panel-body">
					<div class="form-group">
						{!! Form::label('title', 'タイトル', $attributes = array('class' => 'control-label')) !!}

						{!! Form::text('title', $value = Input::old('title', ''), $attributes = array('class' => 'form-control', 'required' => '')) !!}
					</div>

					<div class="form-group">
						{!! Form::label('text', 'Google Drive FileID', $attributes = array('class' => 'control-label')) !!}

						{!! Form::text('text', $value = Input::old('text', ''), $attributes = array('class' => 'form-control', 'required' => '')) !!}
					</div>
				</div>
			</div>

			<div class="panel panel-default">
				<div class="panel-heading">タグ</div>

				<div class="panel-body">
					@foreach ($tags as $tag)
					<div class="checkbox-inline">
						<label class="checkbox-inline">{!! Form::checkbox('tags[]', $tag->id) !!} {{ $tag->name }}</label>
					</div>
					@endforeach
				</div>
			</div>

			<div class="panel panel-default">
				<div class="panel-heading">アイコン</div>

				<div class="panel-body">
					@foreach ($icons as $index => $icon)
					<div class="radio-inline">
						<label class="radio-inline">{!! Form::radio('icon', $icon->id, ($index === 0 ? true : false)) !!} {{ $icon->name }}</label>
					</div>
					@endforeach
				</div>
			</div>
		</div>

		<div class="col-sm-3">
			<div class="form-group">
				{!! Form::select('state', ['public' => '公開', 'private' => '非公開', 'draft' => '下書き'], 'draft', ['class' => 'form-control']) !!}
			</div>

			<div class="form-group">
				{!! Form::submit('新規作成', $attributes = array('class' => 'btn btn-primary btn-block')) !!}
			</div>
		</div>

	</fieldset>
	{!! Form::close() !!}
	@endif
</section>
@stop

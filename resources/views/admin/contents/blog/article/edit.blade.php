@extends('admin.contents.master')

@section('content')
<ol class="breadcrumb">
	<li><a href="{{ route('admin.index') }}"><span class="glyphicon glyphicon-home"></span></a></li>
	<li><a href="{{ route('admin.blog.article.index') }}">投稿管理</a></li>
	<li class="active">{{ $article->title }}</li>
</ol>

@if(Session::has('success'))
<div class="alert alert-success" role="alert">
	<p>{{ Session::get('success') }}</p>
</div>
@endif

@if(Session::has('errors'))
<div class="alert alert-danger" role="alert">
	@foreach($errors->all() as $error)
	<p>{{ $error }}</p>
	@endforeach
</div>
@endif

<section>
	<h2 class="page-header">投稿の編集</h2>

	@if($icons->isEmpty() || $tags->isEmpty())
	<div class="alert alert-warning" role="alert">
		@if($icons->isEmpty())
		<p>アイコンが登録されていません、記事にはアイコンの指定が必須です。アイコンの追加は<a href="{{ route('admin.blog.icon.index') }}">アイコン管理</a>で行ってください。</p>
		@endif

		@if($icons->isEmpty())
		<p>タグが登録されていません、記事にはタグの指定が必須です。タグの追加は<a href="{{ route('admin.blog.tag.index') }}">タグ管理</a>で行ってください。</p>
		@endif
	</div>
	@else
	{!! Form::open(['route' => ['admin.blog.article.update', $article->id], 'method'=>'PUT', 'role' => 'form']) !!}
	{!! Form::hidden('id', $article->id) !!}
	<fieldset class="row">
		<div class="col-sm-9">
			<div class="form-group form-group-sm">
				<div class="form-inline">
					{{ url('/') }}/blog/{!! Form::text('slug', $value = $article->slug, $attributes = array('class' => 'form-control', 'required' => '')) !!}
				</div>
			</div>

			<div class="panel panel-default">
				<div class="panel-heading">記事</div>

				<div class="panel-body">
					<div class="form-group">
						{!! Form::label('title', 'タイトル', $attributes = array('class' => 'control-label')) !!}

						{!! Form::text('title', $value = $article->title, $attributes = array('class' => 'form-control', 'required' => '')) !!}
					</div>

					<div class="form-group">
						{!! Form::label('text', 'Google Drive FileID', $attributes = array('class' => 'control-label')) !!}

						{!! Form::text('text', $value = $article->text, $attributes = array('class' => 'form-control', 'required' => '')) !!}
					</div>
				</div>
			</div>

			<div class="panel panel-default">
				<div class="panel-heading">タグ</div>

				<div class="panel-body">
					@foreach($tags as $tag)
					<div class="checkbox-inline">
						<label class="checkbox-inline">{!! Form::checkbox('tags[]', $tag->id, $article->tags->contains($tag->id)) !!} {{ $tag->name }}</label>
					</div>
					@endforeach
				</div>
			</div>

			<div class="panel panel-default">
				<div class="panel-heading">アイコン</div>

				<div class="panel-body">
					@foreach($icons as $index => $icon)
					<div class="radio-inline">
						<label class="radio-inline">{!! Form::radio('icon', $icon->id, ($icon->id === $article->icon->id ? true : false)) !!} {{ $icon->name }}</label>
					</div>
					@endforeach
				</div>
			</div>
		</div>

		<div class="col-sm-3">
			<div class="form-group">
				{!! Form::select('state', ['public' => '公開', 'private' => '非公開', 'draft' => '下書き', 'delete' => '削除'], $article->state, ['class' => 'form-control']) !!}
			</div>

			<div class="form-group">
				{!! Form::submit('編集', $attributes = array('class' => 'btn btn-primary btn-block')) !!}
			</div>
		</div>
	</fieldset>
	{!! Form::close() !!}

	@endif
</section>
@stop

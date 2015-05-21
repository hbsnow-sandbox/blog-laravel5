@extends('admin.contents.master')

@section('content')
<ol class="breadcrumb">
	<li><a href="{{ route('admin.index') }}"><span class="glyphicon glyphicon-home"></span></a></li>
	<li class="active">タグ管理</li>
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
	<h2 class="page-header">新規タグ登録</h2>

	<div class="row">
		<div class="col-md-4">
			<div class="panel panel-default">

				<div class="panel-body">
					{!! Form::open(['role' => 'form']) !!}
					<fieldset>
						<div class="form-group">
							{!! Form::label('name', 'タグ名', $attributes = array('class' => 'control-label')) !!}

							{!! Form::text('name', $value = Input::old('name', ''), $attributes = array('class' => 'form-control', 'required' => '')) !!}
						</div>

						<div class="form-group">
							{!! Form::label('slug', 'スラッグ', $attributes = array('class' => 'control-label')) !!}

							{!! Form::text('slug', $value = Input::old('slug', ''), $attributes = array('class' => 'form-control', 'required' => '')) !!}
						</div>

						{!! Form::submit('新規追加', $attributes = array('class' => 'btn btn-primary btn-block')) !!}
					</fieldset>
					{!! Form::close() !!}
				</div>
			</div>
		</div>

		<div class="col-md-8">
			@if(!isset($tags) || $tags->isEmpty())
			<div class="alert alert-warning" role="alert">
				<p>タグが登録されていません。新規タグ登録からタグを新規追加してください。</p>
			</div>
			@else

			<div class="panel panel-default">
				<div class="panel-heading">タグ一覧</div>

				<table class="table">
					<thead>
						<tr>
							<th class="col-md-1">ID</th>
							<th class="col-md-6">タグ名</th>
							<th class="col-md-4">スラッグ</th>
							<th class="col-md-1"></th>
						</tr>
					</thead>
					<tbody>
						@foreach($tags as $tag)
						<tr>
							<td>{{ $tag->id }}</td>
							<td><a href="{{ route('admin.blog.tag.edit', $tag->id) }}">{{ $tag->name }}</a></td>
							<td>{{ $tag->slug }}</td>
							<td>
								<a class="close" href="{{ route('admin.blog.tag.show', $tag->id) }}" aria-label="削除">&times;</a>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
			@endif
		</div>
	</div>
</section>
@stop

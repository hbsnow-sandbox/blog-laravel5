@extends('admin.contents.master')

@section('content')
<ol class="breadcrumb">
	<li><a href="{{ route('admin.index') }}"><span class="glyphicon glyphicon-home"></span></a></li>
	<li><a href="{{ route('admin.blog.icon.index') }}">アイコン管理</a></li>
	<li class="active">{{ $selected->name }}</li>
</ol>

@if (Session::has('success'))
<div class="alert alert-success" role="alert">
	<p>{{ Session::get('success') }}</p>
</div>
@endif

@if (Session::has('errors'))
<div class="alert alert-danger" role="alert">
	@foreach($errors->all() as $error)
	<p>{{ $error }}</p>
	@endforeach
</div>
@endif

<section>
	<h2 class="page-header">アイコン編集</h2>

	<div class="row">
		<div class="col-md-4">
			<div class="panel panel-default">
				<div class="panel-body">
					{!! Form::open(['route' => ['admin.blog.icon.update', $selected->id], 'method'=>'PUT', 'role' => 'form']) !!}
					{!! Form::hidden('id', $selected->id) !!}
					<fieldset>
						<div class="form-group">
							{!! Form::label('name', 'アイコン名', $attributes = array('class' => 'control-label')) !!}

							{!! Form::text('name', $selected->name, $attributes = array('class' => 'form-control', 'required' => '')) !!}
						</div>

						<div class="form-group">
							{!! Form::label('url', 'URL', $attributes = array('class' => 'control-label')) !!}

							{!! Form::text('url', $selected->url, $attributes = array('class' => 'form-control', 'required' => '')) !!}
						</div>

						{!! Form::submit('編集', $attributes = array('class' => 'btn btn-primary btn-block')) !!}
					</fieldset>
					{!! Form::close() !!}
				</div>
			</div>
		</div>

		<div class="col-md-8">
			<div class="panel panel-default">
				<div class="panel-heading">編集中のアイコン</div>

				<table class="table">
					<thead>
						<tr>
							<th class="col-md-1">ID</th>
							<th class="col-md-8">アイコン名</th>
							<th class="col-md-3">画像</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>{{ $selected->id }}</td>
							<td>{{ $selected->name }}</td>
							<td><img src="{{ $selected->url }}" alt="{{ $selected->name }}"></td>
						</tr>
					</tbody>
				</table>
			</div>

			<p class="text-right">
				<a href="{{ route('admin.blog.icon.show', $selected->id) }}" class="btn btn-danger">削除</a>
			</p>

			<hr>

			<div class="panel panel-default">
				<div class="panel-heading">アイコン一覧</div>

				<table class="table">
					<thead>
						<tr>
							<th class="col-md-1">ID</th>
							<th class="col-md-8">アイコン名</th>
							<th class="col-md-3">画像</th>
						</tr>
					</thead>
					<tbody>
					@foreach($icons as $icon)
						@if($icon->id === $selected->id)
						<tr class="active">
							<td>{{ $icon->id }}</td>
							<td>{{ $icon->name }}</td>
							<td><img src="{{ $icon->url }}" alt="{{ $icon->name }}"></td>
						</tr>
						@else
						<tr>
							<td>{{ $icon->id }}</td>
							<td><a href="{{ route('admin.blog.icon.edit', $icon->id) }}">{{ $icon->name }}</a></td>
							<td><img src="{{ $icon->url }}" alt="{{ $icon->name }}"></td>
						</tr>
						@endif
					@endforeach
					</tbody>
				</table>
			</div>
		</div>


	</div>
</section>
@stop

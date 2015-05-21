@extends('admin.contents.master')

@section('content')
<ol class="breadcrumb">
	<li><a href="{{ url('admin') }}"><span class="glyphicon glyphicon-home"></span></a></li>
	<li class="active">アイコン管理</li>
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
	<h2 class="page-header">新規アイコン登録</h2>

	<div class="row">
		<div class="col-md-4">
			<div class="panel panel-default">
				<div class="panel-body">
					{!! Form::open(array('role' => 'form')) !!}
					<fieldset>
						<div class="form-group">
							{!! Form::label('name', 'アイコン名', $attributes = array('class' => 'control-label')) !!}

							{!! Form::text('name', $value = Input::old('name', ''), $attributes = array('class' => 'form-control', 'required' => '')) !!}
						</div>

						<div class="form-group">
							{!! Form::label('url', 'URL', $attributes = array('class' => 'control-label')) !!}

							{!! Form::text('url',  $value = Input::old('url', ''), $attributes = array('class' => 'form-control', 'required' => '')) !!}
						</div>

						{!! Form::submit('新規追加', $attributes = array('class' => 'btn btn-primary btn-block')) !!}
					</fieldset>
					{!! Form::close() !!}
				</div>
			</div>
		</div>

		<div class="col-md-8">
			@if(!isset($icons) || $icons->isEmpty())
			<div class="alert alert-warning" role="alert">
				<p>アイコンが登録されていません。新規追加からアイコンを追加登録してください。</p>
			</div>
			@else
			<div class="panel panel-default">
				<div class="panel-heading">アイコン一覧</div>

				<table class="table">
					<thead>
						<tr>
							<th class="col-md-1">ID</th>
							<th class="col-md-8">アイコン名</th>
							<th class="col-md-2">画像</th>
							<th class="col-md-1"></th>
						</tr>
					</thead>
					<tbody>
						@foreach($icons as $icon)
						<tr>
							<td>{{{ $icon->id }}}</td>
							<td><a href="{{ route('admin.blog.icon.edit', $icon->id) }}">{{{ $icon->name }}}</a></td>
							<td><img src="{{ $icon->url }}" alt="{{ $icon->name }}"></td>
							<td>
								<a class="close" href="{{ route('admin.blog.icon.show', $icon->id) }}" aria-label="削除">&times;</a>
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

@extends('admin.contents.master')

@section('content')
<ol class="breadcrumb">
	<li><a href="{{ route('admin.index') }}"><span class="glyphicon glyphicon-home"></span></a></li>
	<li><a href="{{ route('admin.blog.icon.index') }}">アイコン管理</a></li>
	<li class="active">アイコン削除</li>
</ol>

@if(Session::has('errors'))
<div class="alert alert-danger" role="alert">
	@foreach($errors->all() as $error)
	<p>{{ $error }}</p>
	@endforeach
</div>
@endif

<section>
	<h2 class="page-header">アイコン削除</h2>

	<div class="row">
		<div class="col-md-4">
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="form-group">
						{!! Form::label('name', 'アイコン名', $attributes = array('class' => 'control-label')) !!}

						{!! Form::text('name', $value = $icon->name, $attributes = array('class' => 'form-control', 'readonly' => '')) !!}
					</div>

					<div class="form-group">
						{!! Form::label('url', 'URL', $attributes = array('class' => 'control-label')) !!}

						{!! Form::text('url', $value = $icon->url, $attributes = array('class' => 'form-control', 'readonly' => '')) !!}
					</div>
				</div>
			</div>
		</div>

		<div class="col-md-8">
			<div class="panel panel-danger">
				<div class="panel-heading">警告</div>

				<div class="panel-body">
					<p>表示中のアイコンを削除します、一度削除したアイコンを修復することはできないのでご注意ください。</p>
					<p>削除するには以下のフォームにこのアイコンの<strong>URLを入力する</strong>必要があります。</p>

					{!! Form::open(['route'=>['admin.blog.icon.destroy', $icon->id], 'method'=>'DELETE', 'role' => 'form']) !!}
					{!! Form::hidden('slug', $icon->url) !!}
					<fieldset>
						<div class="form-group">
							{!! Form::text('inputed_slug', '', $attributes = array('class' => 'form-control', 'required' => '')) !!}
						</div>

						{!! Form::submit('削除', $attributes = array('class' => 'btn btn-danger')) !!}
					</fieldset>
					{!! Form::close() !!}
				</div>
			</div>

			<p class="text-right">
				<a href="{{ route('admin.blog.icon.edit', $icon->id) }}" class="btn btn-default" role="button">このアイコンの編集</a>
			</p>
		</div>
	</div>
</section>
@stop

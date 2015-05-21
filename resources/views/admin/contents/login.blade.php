@extends('admin.master')

@section('main')
<div class="panel panel-default">
	<div class="panel-body">
		@if(isset($error))
		<div class="alert alert-danger" role="alert">
			<p>{{ $error }}</p>
		</div>
		@endif

		{!! Form::open(array('role' => 'form')) !!}
		<fieldset>
			<div class="form-group">
				{!! Form::label('email', 'メールアドレス', $attributes = array('class' => 'control-label')) !!}

				{!! Form::text('email', $value = Input::old('email', ''), $attributes = array('class' => 'form-control', 'required' => '')) !!}
			</div>

			<div class="form-group">
				{!! Form::label('password', 'パスワード', $attributes = array('class' => 'control-label')) !!}

				{!! Form::password('password', $attributes = array('class' => 'form-control', 'required' => '')) !!}
			</div>

			{!! Form::submit('ログインする', $attributes = array('class' => 'btn btn-primary')) !!}
		</fieldset>
		{!! Form::close() !!}
	</div>
</div>
@stop


@extends('admin.contents.master')

@section('content')
	<p>{{ $user->username }}でログイン中です。</p>

	<p><a href="{{ url('admin/logout') }}" class="btn btn-default">ログアウト</a></p>
@stop
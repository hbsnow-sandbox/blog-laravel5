@extends('contents.master')

@section('title')
500 Internal Server Error
@stop

@section('content')
	<p>サーバエラーが発生しました。</p>

	<p>Google Driveの接続に失敗したのかもしれません。しばらく時間がたってから再度アクセスするか、それでもこのページが表示されてしまう場合には、お手数ですが<a ui-sref="contact">管理者までご連絡</a>ください。</p>
@stop

@extends('master')

@section('main')
<section class="main-root">
	<header id="content-header">
		@yield('breadcrumb')

		<div id="content-header-title">
			<div class="container">
				@if (isset($title))
				<h1 id="main-title">{{ $title }}</h1>
				@else
				<h1 id="main-title">@yield('title')</h1>
				@endif
			</div>
		</div>

		@yield('meta')
	</header>

	@yield('nav')

	<div id="content-body">
		<div class="container">
			@yield('content')
		</div>
	</div>
</section>
@stop

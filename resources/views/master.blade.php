@if (!isset($pjax) || !$pjax)
<!DOCTYPE html>
<html lang="ja" ng-app="mainApp">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">

		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="fragment" content="!">

		@if (isset($description))
		<meta name="description" content="{{ $description }}">
		@endif

		<title page-title>
		@if (isset($content_title))
			{{ $content_title . ' | ' }}
		@elseif (isset($title))
			{{ $title . ' | ' }}
		@endif
			4uing
		</title>

		<base href="{{ str_finish(route('index'), '/') }}">

		<link rel="alternate" type="application/xml" href="{{ route('blog.rss') }}" title="RSS update information">
		<link rel="copyright" href="{{ route('about.index') }}">

		<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Lato:400,700">
		<link rel="stylesheet" href="{{ asset('assets/styles/main.css') }}">
	</head>

	<body>
		<!--[if lte IE 9.0]>
		<div id="legacy-ie">
			<p>このサイトはIE10未満のブラウザでは正常に表示されません。最新のブラウザを使用する、もしくはスマートフォンなどからアクセスしてください。</p>

			<div class="text-center">
				<img src="{{ asset('assets/images/qrcode.png') }}" alt="QRコード">
			</div>
		</div>
		<![endif]-->

		<div class="layout vertical">
			<header id="header" class="flex-none">
				<div class="container">
					<h1 id="site-title"><a ui-sref="home">4uing</a></h1>

					<nav id="header-menu">
						<icon css-icon="menu" alt="Menu"></icon>

						<ul>
							<li ui-sref-active="selected"><a ui-sref="blog">Blog</a></li><li ui-sref-active="selected"><a ui-sref="work">Work</a></li><li ui-sref-active="selected"><a ui-sref="about">About</a></li>
						</ul>
					</nav>
				</div>
			</header>

			<main id="main" class="flex-auto">
				<div ui-view>
					@yield('main')
				</div>
			</main>

			<footer id="footer" class="flex-none">
				<div class="container">
					<div id="footer-social">
						<ul class="layout horizontal">
							<li class="flex"><a href="https://twitter.com/hbsnow">Twitter</a></li>
							<li class="flex"><a href="https://github.com/hbsnow">GitHub</a></li>
							<li class="flex"><a href="{{ route('blog.rss') }}" target="_blank">RSS</a></li>
						</ul>
					</div>

					<div id="footer-copyright">
						<p>&copy; {{ date('Y') }}</p>
					</div>
				</div>
			</footer>

			<pageloader></pageloader>

			<preloader>
				<div class="cage">
					<div class="box">
						<div class="drop-one"></div>
						<div class="drop-two"></div>
						<div class="ripple l-side"></div>
						<div class="ripple r-side"></div>
					</div>
				</div>

				<div class="cage two">
					<div class="box">
						<div class="drop-three"></div>
						<div class="drop-four"></div>
					</div>
				</div>

				<svg xmlns="http://www.w3.org/2000/svg" version="1.1" width="">
					<defs>
						<filter id="goo">
							<feGaussianBlur in="SourceGraphic" stdDeviation="15" result="blur"/>
							<feColorMatrix in="blur" mode="matrix" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 19 -9" result="goo"/>
							<feComposite in="SourceGraphic" in2="goo" operator="atop"/>
						</filter>
					</defs>
				</svg>

				<svg xmlns="http://www.w3.org/2000/svg" version="1.1" width="">
					<defs>
						<filter id="goo2">
							<feGaussianBlur in="SourceGraphic" stdDeviation="8" result="blur"/>
							<feColorMatrix in="blur" mode="matrix" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 19 -9" result="goo"/>
							<feComposite in="SourceGraphic" in2="goo" operator="atop"/>
						</filter>
					</defs>
				</svg>
			</preloader>

			<div id="javascript">
				<script src="{{ asset('assets/scripts/main.js') }}"></script>
			</div>
		</div>
	</body>

</html>
@else
	@yield('main')
@endif

<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="utf-8">

		<title>管理者ページ</title>

		<meta name="ROBOTS" content="NOINDEX, NOFOLLOW, NOARCHIVE">

		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
	</head>

	<body>
		<nav class="navbar navbar-default" role="navigation">
			<div class="container">
				<div class="navbar-header">
					<a class="navbar-brand" href="{{ route('admin.index') }}">管理者ページ</a>
				</div>
			</div>
		</nav>

		<div class="container">
			@yield('main')
		</div>
	</body>
</html>

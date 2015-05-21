module.exports = function(
	$stateProvider,
	$locationProvider,
	$urlRouterProvider,
	$interpolateProvider
) {

	var query = '?_pjax=true';

	$stateProvider
		.state('home', {
			url: '/',
			templateUrl: 'index' + query,
			data: {
				pageTitle: 'Home'
			}
		})
		.state('about', {
			url: '/about',
			templateUrl: 'about' + query,
			data: {
				pageTitle: 'About'
			}
		})
		.state('work', {
			url: '/work',
			templateUrl: 'work' + query,
			data: {
				pageTitle: 'Work'
			}
		})
		.state('blog', {
			url: '/blog',
			templateUrl: 'blog' + query,
			data: {
				pageTitle: 'Blog'
			}
		})
		.state('blog-single', {
			url: '/blog/{slug:[a-z0-9-\.]+}',
			templateUrl: function($stateParams) {
				return 'blog/' + $stateParams.slug + query;
			},
			data: {
				//
			}
		})
		.state('blog-archives', {
			url: '/blog/archives/{slug:[a-z0-9-\.]+}',
			templateUrl: function($stateParams) {
				return 'blog/archives/' + $stateParams.slug + query;
			},
			data: {
				pageTitle: 'Archives'
			}
		})
		.state('blog-tag', {
			url: '/blog/tag/{slug:[a-z0-9-\.]+}',
			templateUrl: function($stateParams) {
				return 'blog/tag/' + $stateParams.slug + query;
			},
			data: {
				pageTitle: 'Tag'
			}
		})
		.state('contact', {
			url: '/contact',
			templateUrl: 'contact' + query,
			data: {
				pageTitle: 'Contact'
			}
		})
		.state('404', {
			templateUrl: '/errors/404' + query,
			data: {
				pageTitle: '404 Not Found'
			}
		})
		.state('500', {
			templateUrl: '/errors/500' + query,
			data: {
				pageTitle: '500 Internal Server Error'
			}
		});

	$urlRouterProvider
		.when('', '/')
		.otherwise(function($injector) {
			$injector.get('$state').go('404');
		});

	$locationProvider.html5Mode(true).hashPrefix('!');

	// Laravel bladeとの衝突を回避
	$interpolateProvider.startSymbol('[[');
	$interpolateProvider.endSymbol(']]');

};

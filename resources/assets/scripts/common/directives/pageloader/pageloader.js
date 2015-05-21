module.exports = function($state, $animate, $injector, $location) {
	return {
		restrict: 'E',
		template: require('./pageloader.html'),
		link: function(scope, element) {
			var parent = element[0].parentNode;
			parent.removeChild(element[0]);

			scope.$on('$stateChangeStart', function(event, toState, toParams, fromState, fromParams) {
				if (! document.getElementsByTagName('preloader')[0]) {
					$animate.enter(element[0], parent, document.getElementById('footer'));
				}
			});

			scope.$on('$viewContentLoaded', function(event) {
				if (! document.getElementsByTagName('preloader')[0]) {
					window.scroll(0, 0);
					$animate.leave(element[0]);
				}
			});

			scope.$on("$stateChangeError", function(event, toState, toParams, fromState, fromParams, error) {
				if (error.status === 503) {
					$injector.get('$state').go('503');
				} else if (error.status === 500) {
					$injector.get('$state').go('500');
				} else if (error.status === 404) {
					$injector.get('$state').go('404');
				}
			});
		}
	};
};

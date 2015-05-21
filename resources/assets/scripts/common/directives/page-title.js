module.exports = function($state) {
	return {
		restrict: 'A',
		link: function(scope, element) {
			var title, pipe;

			scope.$on('$stateChangeSuccess', function() {
				title = ($state.current.data.pageTitle !== undefined) ? $state.current.data.pageTitle : 'Loading';

				if(title === 'Home') {
					title = '';
					pipe = '';
				} else {
					pipe = ' | ';
				}

				element.html(title + pipe + '4uing');
			});

			scope.$on('$viewContentLoaded', function() {
				if(title === 'Loading') {
					title = document.querySelector('#main-title').childNodes[0].nodeValue;
					element.html(title + pipe + '4uing');
				}
			});
		}
	};
};

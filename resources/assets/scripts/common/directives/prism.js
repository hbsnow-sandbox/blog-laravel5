module.exports = function($state, $animate) {
	return {
		restrict: 'A',
		link: function(scope, element) {
			scope.$on('$viewContentLoaded', function() {
				Prism.highlightElement(element[0].childNodes[0]);
			});
		}
	};
};

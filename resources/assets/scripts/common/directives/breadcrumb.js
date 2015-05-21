module.exports = function() {
	return {
		restrict: 'E'
	};
};

/*
module.exports = function($state, $animate) {
	return {
		restrict: 'A',
		link: function(scope, element, attr) {
			scope.$on('$viewContentLoaded', function() {
				$animate.addClass(element, 'optiscroll-content')
				.then(function() {
					var elem;
					if (attr.optiscroll === '') {
						elem = '<div class="optiscroll"/>';
					} else {
						elem = '<div class="optiscroll optiscroll-' + attr.optiscroll + '"/>';
					}

					hljs.highlightBlock(elem);
				})
				.then(function() {
					var optiscroll = new Optiscroll(element.parent()[0], {
						//
					});
				});

			});
		}
	};
};

*/
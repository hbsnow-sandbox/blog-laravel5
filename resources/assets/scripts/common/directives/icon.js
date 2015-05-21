module.exports = function($state, $animate) {
	return {
		restrict: 'E',
		link: function(scope, element, attribute) {
			element.html('<div class="icon"><span>' + attribute.alt + '</span></div>');

			element.bind('click', function() {
				element.toggleClass('active');
			});
		}
	};
};

module.exports = function() {
	return {
		restrict: 'A',
		link: function(scope, element, attribute) {
			element.addClass('hover-effect-' + attribute.hoverEffect).attr('data-clone', element.text());
		}
	};
};

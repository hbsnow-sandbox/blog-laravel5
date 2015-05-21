(function() {
	'use strict';

	// library
	require('../../vendor/scripts/prism.js');

	// AngularJS
	require('angular');
	require('angular-animate');
	require('angular-ui-router');

	var appName = 'mainApp';
	var app = angular.module(appName, [
		'ngAnimate',
		'ui.router'
	]);

	app.config(require('./config.js'));
	app.run(require('./run.js'));

	// directive
	app.directive('pageTitle', require('./common/directives/page-title.js'));
	app.directive('pageloader', require('./common/directives/pageloader/pageloader.js'));
	app.directive('preloader', require('./common/directives/preloader.js'));
	app.directive('prism', require('./common/directives/prism.js'));
	app.directive('icon', require('./common/directives/icon.js'));
	app.directive('hoverEffect', require('./common/directives/hover-effect.js'));

})();

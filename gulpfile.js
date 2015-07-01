'use strict';

var gulp = require('gulp');
var del = require('del');
var runSequence = require('run-sequence');
var $ = require('gulp-load-plugins')();

var path = {
  'assets': 'resources/assets/',
  'dist': 'public/assets/',
  'vendor': 'resources/vendor/',
  'less': 'styles/main.less',
  'js': 'scripts/main.js'
}

var watch = false



/**
 * LESS
 */

gulp.task('build:less', function() {
  if(watch) {
    return gulp.src(path.assets + path.less)
      .pipe($.plumber())
      .pipe($.sourcemaps.init())
      .pipe($.less())
      .pipe($.sourcemaps.write())
      .pipe($.autoprefixer())
      .pipe(gulp.dest(path.dist + 'styles/'));
  } else {
    return gulp.src(path.assets + path.less)
      .pipe($.less())
      .pipe($.autoprefixer())
      .pipe($.minifyCss())
      .pipe(gulp.dest(path.dist + 'styles/'))
      .pipe($.gzip())
      .pipe(gulp.dest(path.dist + 'styles/'));
  }
});



/**
 * JavaScript
 */

gulp.task('jshint', function () {
  return gulp.src(path.assets + 'scripts/**/*.js')
    .pipe($.jshint())
    .pipe($.jshint.reporter('jshint-stylish'));
});



gulp.task('build:js', function() {
  var src = path.assets + path.js;
  var config = {
    entry: src,
    output: {
      filename: '[name].js'
    },
    module: {
      loaders: [
        {
          test: /\.html$/,
          loader: 'html'
        },
      ]
    }
  };

  if(watch) {
    config.watch = true;
    config.devtool = '#inline-source-map';
    return gulp.src(src)
      .pipe($.webpack(config))
      .pipe(gulp.dest(path.dist + 'scripts/'));
  } else {
    return gulp.src(src)
      .pipe($.webpack(config))
      .pipe($.uglify({
        mangle: false
      }))
      .pipe(gulp.dest(path.dist + 'scripts/'))
      .pipe($.gzip())
      .pipe(gulp.dest(path.dist + 'scripts/'));
  }
});



/**
 * watch
 */

gulp.task('watch', ['clean'], function(cb) {
  watch = true;

  runSequence('build', function() {
    gulp.watch(path.assets + 'scripts/**/*.js', ['jshint', 'build:js']);
    gulp.watch(path.assets + 'styles/**/*.less', ['build:less']);
    cb();
  });
});



/**
 * build
 */

gulp.task('clean', function(cb) {
  del(['dist/**/*', '!dist/images/**/*'], cb);
});

gulp.task('build', ['clean'], function (cb) {
  runSequence(['build:less', 'build:js'], cb);
});



/**
 * default
 */

gulp.task('default', ['watch']);

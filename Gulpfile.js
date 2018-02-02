/**
 * REQUIREMENTS
 */
var gulp = require('gulp'),
sass = require('gulp-sass'),
plumber = require('gulp-plumber'), // Prevent gulp from exiting on error
autoprefixer = require('gulp-autoprefixer'),
sourcemaps = require('gulp-sourcemaps'),
browserSync = require('browser-sync'), //Auto refresh browser on file save
merge = require('merge-stream'), // Require merge-stream to output multilple tasks to multiple destinations
cssmin = require('gulp-cssmin'),
uglify = require('gulp-uglifyjs'),
imagemin = require('gulp-imagemin'),
rename = require('gulp-rename'),
cache = require('gulp-cache');

// Internal config, folder structure
var paths = {
  style: {
    source: 'app/sass/',
    destination: 'dist/css/',
  },
  script: {
    source: 'app/js/**/*.js',
    // source: ['app/js/classes/*.js', 'app/js/*.js'],
    destination: 'dist/js/',
  }
};

// Starting server
gulp.task('browser-sync', function() {
  // watch files
  var files = [
    './style.css',
    './*.php'
  ];

  // initialize browsersync
  browserSync.init(files, {
    proxy: "http://localhost/wordpress/",
    notify: false
  });
});

gulp.task('images', function(){
  gulp.src('app/img/**/*')
    .pipe(cache(imagemin({ optimizationLevel: 3, progressive: true, interlaced: true })))
    .pipe(gulp.dest('dist/img/'));
});

gulp.task('js', function() {
  gulp.src(paths.script.source)
    .pipe(uglify('wp.min.js'))
    .pipe(gulp.dest(paths.script.destination))
    .pipe(browserSync.reload({
      stream: true
    }));
});

try {
  gulp.task('sass', function() {
      return gulp
        .src(paths.style.source + 'style.scss')
        .pipe(plumber())
        .pipe(sourcemaps.init())
        .pipe(sass().on('error', sass.logError)) // Initialize sass
        .pipe(autoprefixer()) // Passes it through gulp-autoprefixer
        .pipe(sourcemaps.write()) // Writing sourcemaps
        .pipe(cssmin().on('error', function(err) {
          console.log(err);
        }))
        .pipe(rename({
          suffix: '.min'
        }))
        .pipe(gulp.dest(paths.style.destination))
        .pipe(browserSync.reload({
            stream: true
        }));
  });
} catch(e) {
  console.log("HEJ JAG ÄR ETT FEL", e.stack);
}

gulp.task('default', ['browser-sync', 'sass', 'js', 'images'], function(){
  gulp.watch(paths.style.source + '**/*.scss', ['sass']);
  gulp.watch(paths.script.source, ['js']);
  gulp.watch('**/*.php', browserSync.reload);
});

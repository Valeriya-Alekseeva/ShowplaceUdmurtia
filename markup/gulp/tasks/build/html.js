var gulp = require('gulp'),
    jade = require('gulp-jade'),
    config = require('../config.json');

gulp.task('html', function() {

    return gulp.src(config.src + '/html-template/pages/**/*.jade')
        .pipe(jade({
            pretty: true
        }))
        .on('error', function (err) {
            console.error('Error!', err.message);
        })
        .pipe(gulp.dest(config.dest));
});
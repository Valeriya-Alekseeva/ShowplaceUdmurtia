var gulp = require('gulp'),
    uglify = require('gulp-uglify'),
    useref = require('gulp-useref'),
    gulpif = require('gulp-if'),
    environmentVariable = require('../environmentVariable'),
    merge = require('merge-stream'),
    config = require('../config.json');

gulp.task('js', ['html'], function(){

    var isProd = environmentVariable.getEnv();
    var assets = useref.assets();

    // for prod
    var useRefStream = gulpif(isProd, gulp.src(config.dest + '/*.html'))
        .pipe(assets)
        .pipe(gulpif('*.js', uglify()))
        .pipe(assets.restore())
        .pipe(useref())
        .pipe(gulp.dest(config.dest));

    // for dev
    var copyJsStream = gulp.src(config.src + '/js/**/*.js')
        .pipe(gulpif(!isProd, gulp.dest(config.dest + '/js')));

    var copyBowerStream = gulp.src('./bower_components/**/*.js')
        .pipe(gulpif(!isProd, gulp.dest(config.dest + '/bower_components')));

    if (isProd) {
        return useRefStream;
    }

    return merge(copyJsStream, copyBowerStream);
});
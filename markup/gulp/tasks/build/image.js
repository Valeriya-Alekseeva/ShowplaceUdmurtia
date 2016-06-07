var gulp = require('gulp'),
    imagemin = require('gulp-imagemin'),
    gulpif = require('gulp-if'),
    environmentVariable = require('../environmentVariable'),
    config = require('../config.json');

gulp.task('image', function(){

    var isProd = environmentVariable.getEnv();

    return gulp.src(config.src + '/img/**/*')
        //.pipe(gulpif(isProd, imagemin({
        //    progressive: true
        //})))
        .pipe(gulp.dest(config.dest + '/img'));
});
var gulp = require('gulp'),
    rename = require('gulp-rename'),
    sass = require('gulp-ruby-sass'),
    minifyCss = require('gulp-minify-css'),
    gulpif = require('gulp-if'),
    autoprefixer = require('gulp-autoprefixer'),
    environmentVariable = require('../environmentVariable'),
    sourcemaps = require('gulp-sourcemaps'),
    config = require('../config.json');

gulp.task('css', function(){

    var isProd = environmentVariable.getEnv();

    return sass(config.src + '/scss/controller.scss', {
            style: 'expanded',
            sourcemap: !isProd
        })
        .on('error', function(err){
            console.error('Error!', err.message);
        })
        .pipe(autoprefixer({
            browsers: ['last 3 versions'],
            cascade: false
        }))
        .pipe(sourcemaps.write())
        .pipe(gulpif(isProd, minifyCss()))
        .pipe(rename({basename: 'style'}))
        .pipe(gulp.dest(config.dest + '/css'));
});
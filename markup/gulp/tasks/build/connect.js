var gulp = require('gulp'),
    connect = require('gulp-connect'),
    config = require('../config.json');

gulp.task('connect', function() {

    connect.server({
        root: config.dest,
        port: 1234
    });
});
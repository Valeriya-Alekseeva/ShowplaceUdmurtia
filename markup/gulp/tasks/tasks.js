var gulp = require('gulp'),
    del = require('del'),
    runSequence = require('run-sequence'),
    minimist = require('minimist'),
    environmentVariable = require('./environmentVariable'),
    config = require('./config.json');

gulp.task('watch', function() {

    gulp.watch(config.src + '/scss/**/*.scss', ['css']);
    gulp.watch(config.src + '/js/**/*.js', ['js']);
    gulp.watch(config.src + '/html-template/**/*', ['html']);
    gulp.watch(config.src + '/img/**/*', ['image']);
    gulp.watch(config.src + '/font/**/*', ['font']);
    gulp.watch(config.src + '/mock/**/*', ['mock']);
    gulp.watch(config.src + '/svg/**/*', ['svg']);
});

gulp.task('assets', function(){

    del(
        [
            config.backendResourcesPath + '/img',
            config.backendResourcesPath + '/svg',
            config.backendResourcesPath + '/js',
            config.backendResourcesPath + '/css',
            config.backendResourcesPath + '/markup' // удалить, когда у Леры будет собираться проект
        ],
        {
            force: true
        },
        function(){

            gulp.src(config.dest + '/svg/**/*')
                .pipe(gulp.dest(config.backendResourcesPath + '/svg'));

            gulp.src(config.dest + '/img/**/*')
                .pipe(gulp.dest(config.backendResourcesPath + '/img'));

            gulp.src(config.dest + '/js/**/*')
                .pipe(gulp.dest(config.backendResourcesPath + '/js'));

            gulp.src(config.dest + '/css/**/*')
                .pipe(gulp.dest(config.backendResourcesPath + '/css'));

            gulp.src(config.dest + '/*.html')                               // удалить, когда у Леры будет собираться проект
                .pipe(gulp.dest(config.backendResourcesPath + '/markup'));  //
        }
    );
});

gulp.task('build', function(callback) {
    runSequence(
        'clean',
        [
            'css',
            'image',
            'svg',
            'js',
            'mock',
            'font',
            'html'
        ],
        callback
    );
});

var options = minimist(process.argv.slice(2), {string: 'only'});
gulp.task('build-prod', function(callback) {

    environmentVariable.setEnv(true);

    var onlyWhichTask = options.only;
    if (onlyWhichTask) {
        runSequence(
            onlyWhichTask,
            callback
        );
    } else {
        runSequence(
            'build',
            callback
        );
    }
});

gulp.task('install', function(callback){
    environmentVariable.setEnv(true);

    runSequence(
        'build',
        'assets',
        callback
    );
});

gulp.task('default', function(callback) {

    runSequence(
        'clean',
        'build',
        [
            'watch',
            'connect'
        ],
        callback
    );
});

var gulp       = require('gulp');
var bower      = require('gulp-bower');
var uglify     = require('uglify-stream');
var less       = require('gulp-less');
var browserify = require('browserify');
var glob       = require('glob');
var es         = require('event-stream');
var source     = require('vinyl-source-stream');
var rename     = require('gulp-rename');
var concat     = require('gulp-concat');

gulp.task('bower', bower);

gulp.task('less', ['bower'], function() {
    return gulp.src('./src/Assets/less/**/*.less')
        .pipe(less())
        //.pipe(uglify())
        .pipe(gulp.dest('./web/css'));
});

gulp.task('browserify', ['bower'], function(done) {
    glob('./src/js/*.js', function(err, files) {
        if(err) done(err);

        var tasks = files.map(function(entry) {
            var b = browserify(entry);
            b.plugin('browserify-bower', {
                require: ['*', 'jquery-ui']
            });

            return b.bundle()
                .pipe(source(entry))
                .pipe(rename({
                    dirname: './'
                }))
                //.pipe(uglify())
                .pipe(gulp.dest('./web/js'));
        });

        es.merge(tasks).on('end', done);
    });
});

gulp.task('jqueryUIStyle', ['bower'], function(){
    return gulp.src('./bower_components/jquery-ui/themes/base/*.css')
        .pipe(concat('jquery-ui.css'))
        .pipe(gulp.dest('./web/css'));
});

gulp.task('glyphicons', ['bower'], function() {
    return gulp.src('./bower_components/bootstrap/fonts/*')
        .pipe(gulp.dest('./web/fonts'));
});

gulp.task('default', ['browserify', 'less', 'glyphicons', 'jqueryUIStyle']);
var gulp = require('gulp'),
    uglify = require('gulp-uglify'),
    rename = require('gulp-rename'),
    sass = require('gulp-sass'),
    prefix = require('gulp-autoprefixer'),
    livereload = require('gulp-livereload'),
    concat = require('gulp-concat');

gulp.task('css', function() {
    gulp.src('css/*.scss')
        .pipe(sass({
            outputStyle: 'compressed',
        }).on('error', sass.logError))
        .pipe(prefix())
        .pipe(rename({suffix: '.min'}))
        .pipe(gulp.dest('css'))
        .pipe(livereload());
});

gulp.task('js', function() {
    return gulp.src('js/*.js')
        .pipe(uglify())
        .on('error', function(e) {
            console.log(e.message);
            this.emit('end');
        })
        .pipe(rename({suffix: '.min'}))
        .pipe(gulp.dest('js/build'))
        .pipe(livereload());
});

gulp.task('js-vendor', function() {
    return gulp.src('js/vendor/*.js')
        .pipe(concat('vendor.min.js'))
        .pipe(uglify())
        .on('error', function(e) {
            console.log(e.message);
            this.emit('end');
        })
        .pipe(gulp.dest('js/build'))
        .pipe(livereload());
});

gulp.task('watch', function() {
    livereload.listen();
    gulp.watch('css/**/*.scss', ['css']);
    gulp.watch('js/*.js', ['js']);
    gulp.watch('js/vendor/*.js', ['js-vendor']);
});

gulp.task('default', ['css', 'js', 'js-vendor']);

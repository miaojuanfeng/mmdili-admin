/* 
	npm install gulp-sass gulp-minify-css gulp-notify gulp-plumber gulp-uglify gulp-concat gulp-autoprefixer gulp-rename browser-sync gulp
*/

var gulp = require('gulp');
var sass = require('gulp-sass');
var cssmin = require('gulp-minify-css');
var notify = require('gulp-notify');
var plumber = require('gulp-plumber');
var uglify= require('gulp-uglify');
var concat = require('gulp-concat');
var autoprefixer = require('gulp-autoprefixer');
var rename = require('gulp-rename');
var browserSync = require('browser-sync').create();
var reload      = browserSync.reload;

gulp.task('css', function(){
	gulp.src('src/*.scss')
	.pipe(plumber({errorHandler: notify.onError('Error: <%= error.message %>')}))
	.pipe(concat('style.css'))
	.pipe(rename({ suffix: '.min' }))
	.pipe(sass())
	.pipe(autoprefixer({
        browsers: ['last 8 versions'],
        cascade: true, //是否美化属性值 默认：true 像这样：
        //-webkit-transform: rotate(45deg);
        //        transform: rotate(45deg);
        remove: true //是否去掉不必要的前缀 默认：true 
    }))
	// .pipe(cssmin())
	.pipe(gulp.dest('assets/css/'));
});

gulp.task('js', function(){
	gulp.src('src/*.js')
	.pipe(plumber({errorHandler: notify.onError('Error: <%= error.message %>')}))
	.pipe(rename({ suffix: '.min' }))
	.pipe(uglify())
	.pipe(gulp.dest('assets/js/'));
});

// gulp.task('concat', function(){
// 	gulp.src(['js/*.js', '!js/all.js'])
// 	.pipe(concat('all.js'))
// 	.pipe(gulp.dest('js/'))
// 	.pipe(reload({stream: true}));
// });

gulp.task('watch', function(){
	browserSync.init({
        server: "./"
    });
	gulp.watch('src/*.{scss,js}', ['css', 'js'/*, 'concat'*/]);
	gulp.watch("*.html").on('change', reload);
})
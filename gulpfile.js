var gulp = require('gulp');
var rename = require("gulp-rename");
var autoprefixer = require('gulp-autoprefixer');
var cleanCSS = require('gulp-clean-css');
var sass = require('gulp-sass');
var jslint = require('gulp-jslint');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var browserSync = require('browser-sync');

var plugin_name = "jtrt-responsive-tables";
var folders = ["admin","public"];



gulp.task('browser-sync', function() {
  browserSync({
    proxy:"http://localhost/projects/tables_development"
  });
   gulp.watch("*/**/*.php").on("change", browserSync.reload);
});

gulp.task('bs-reload', function () {
  browserSync.reload();
});

gulp.task('styles', function() {

	var tasks = folders.map(function(f_name){
		gulp.src(f_name + "/css/scss/[^_]*.scss")
		.pipe(sass())
		.pipe(autoprefixer('last 2 versions'))
		.pipe(gulp.dest(f_name + "/css"))
		.pipe(cleanCSS())
		.pipe(rename({suffix:".min"}))
		.pipe(gulp.dest("dist/"+f_name+"/css"))
		.pipe(browserSync.reload({stream:true}));
	});

	return tasks;

});

gulp.task('scripts', function() {

	var tasks = folders.map(function(f_name){
		gulp.src(f_name + '/js/*.js')
		.pipe(jslint())
		.pipe(uglify())
		.pipe(rename({suffix:".min"}))
		.pipe(gulp.dest("dist/"+f_name+"/js"))
		.pipe(browserSync.reload({stream:true}));
	});

	return tasks;

});

gulp.task('console-test', function() {

	console.log('working');

});

gulp.task('vendors', function() {

	var tasks = folders.map(function(f_name){
		gulp.src(f_name + '/js/vendor/*.js')
		.pipe(concat(plugin_name+'-vendor-'+f_name+'.js'))
		.pipe(uglify())
		.pipe(rename({suffix:".min"}))
		.pipe(gulp.dest("dist/"+f_name+"/js"))
		.pipe(browserSync.reload({stream:true}));
	});

	return tasks;

});

gulp.task('default', ['browser-sync'], function(){
  folders.map(function(f_name){
  	gulp.watch(f_name + "/css/**/*.scss",['styles']).on("change",function(e){
		 console.log(e);
	  });
  	gulp.watch(f_name + "/js/*.js",['scripts']).on("change",function(e){
		 console.log(e);
	  });
  	gulp.watch(f_name + "/js/vendor/*.js",['vendors']).on("change",function(e){
		 console.log(e);
	  });
  });
});
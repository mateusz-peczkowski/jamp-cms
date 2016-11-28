require('es6-promise').polyfill();


var userconfig     = require('./domain_config.json');
var DOMAIN          = userconfig.DOMAIN || 'system.dev';


var gulp            = require('gulp');
var sass            = require('gulp-sass');
var sassLint        = require('gulp-sass-lint');
var autoprefixer    = require('autoprefixer');

var CleanCSS        = require('clean-css');
var vinylMap        = require('vinyl-map');

var uglify          = require('gulp-uglify');
var watchify        = require('watchify');
var browserify      = require('browserify');
var babelify        = require('babelify');
var source          = require('vinyl-source-stream');
var gutil           = require('gutil');

var jshint          = require('gulp-jshint');
var stylish         = require('jshint-stylish');

var lost            = require('lost');
var postcss         = require('gulp-postcss');
var cssMqpacker     = require('css-mqpacker');

var browserSync = require('browser-sync').create();


var imagemin = require('gulp-imagemin');
//var pngquant = require('imagemin-pngquant');

var relativePathDistCSSFolder = './css';


var processors = [
    lost(),
    autoprefixer({
        browsers: ['> 1% in PL', 'IE >= 9', 'last 2 version']
    }),
    cssMqpacker
];

gulp.task('sass', function () {
    'use strict';

    return gulp.src('./src/scss/app.scss')
        .pipe(
            sass(
            //{errLogToConsole: true}
            ).on('error', sass.logError)
        )
        .pipe(postcss(processors))
        .pipe(gulp.dest(relativePathDistCSSFolder))
        .pipe(browserSync.reload({ stream: true }));
});

gulp.task('minify-css', ['sass'], function () {
    'use strict';

    var minify = vinylMap(function (buff) {
        return new CleanCSS({
            relativeTo: relativePathDistCSSFolder,
            processImport: true,
            advanced: false
        }).minify(buff.toString()).styles;
    });

    return gulp.src(relativePathDistCSSFolder + '/styles.css')
        .pipe(minify)
        .pipe(gulp.dest(relativePathDistCSSFolder));
});

gulp.task('sass-lint', ['minify-css'], function () {
    'use strict';

    return gulp.src([
            './src/scss/**/*.scss',
        ])
        .pipe(sassLint())
        .pipe(sassLint.format())
        .pipe(sassLint.failOnError());
});

gulp.task('js-lint', ['js'], function() {
    'use strict';

    return gulp.src([
            './src/js/**/*.js',
            './gulpfile.js',

            '!./src/js/customs/**/*.js',
            '!./src/js/trans/**/*.js'
        ])
        .pipe(jshint())
        .pipe(jshint.reporter(stylish))
        .pipe(browserSync.reload({ stream: true }));
        //.pipe(jshint.reporter('fail'));
});

var bundler = watchify(
    browserify({
        entries: ['./src/js/app.js'],
        cache: {},
        packageCache: {},
        debug: true
    })
    .transform(babelify.configure({
        // You can configure babel here!
        // https://babeljs.io/docs/usage/options/
        compact: true,
        presets: ['es2015']
    })))
    //.on('update', initBrowserify)
    .on('log', gutil.log);

function initBrowserify() {
    'use strict';

    return bundler.bundle()
        .on('error',
            //gutil.log.bind(gutil, 'Browserify Error')
            function (err) {
                console.log(err.toString());
                this.emit('end');
            }
        )
        .pipe(source('app.js'))
        // .pipe(buffer())
        // .pipe(sourcemaps.init({loadMaps: true}))
        // .pipe(sourcemaps.write('./'))
        .pipe(gulp.dest('./js'));
}

gulp.task('js', initBrowserify);

gulp.task('minify-scripts-trans', ['js'], function () {
    'use strict';

    return gulp.src([
            './src/js/trans/**/*.js'
        ])
        .pipe(uglify())
        .pipe(gulp.dest('./js/trans'));
});

gulp.task('minify-js', function () {
    'use strict';

    return gulp.src([
            './js/app.js'
        ])
        .pipe(uglify())
        .pipe(gulp.dest('./js'))
        .on('end', function () {
            console.log('\n===\n You can commit now.\n===\n');
        });
});

gulp.task('compress-img', function () {
    'use strict';

    return gulp.src('./src/img/**/*.{jpg,gif,png}')
    .pipe(imagemin({
        optimizationLevel: 5,
        progressive: true,
        interlaced: true
        //use: [pngquant()]
    }))
    .pipe(gulp.dest('./img/'));
});

gulp.task('compress-svg', function() {
    'use strict';

    return gulp.src('./src/img/**/*.svg')
        .pipe(imagemin({
            svgoPlugins: [{
                removeViewBox: false,
                removeUselessStrokeAndFill: false,
                removeEmptyAttrs: false,
                removeUnknownsAndDefaults: false,
                removeUselessDefs: false,
                removeHiddenElems: false,
                removeEmptyText: false,
                removeEmptyContainers: false,
                removeNonInheritableGroupAttrs: false,
                cleanupIDs: false
            }]
        }))
        .pipe(gulp.dest('./img/'));
});

gulp.task('watch', ['sass-lint', 'js-lint', 'minify-scripts-trans', 'minify-js', 'compress-img', 'compress-svg'], function () {
    'use strict';

    browserSync.init({
        proxy: DOMAIN
    });

    gulp.watch('./src/scss/**/*.scss', ['sass-lint']);
    gulp.watch('./src/img/**/*.{jpg,gif,png}', ['compress-img']);
    gulp.watch('./src/img/**/*.svg', ['compress-svg']);
    gulp.watch(['./src/js/**/*.js', './gulpfile.js'], ['js-lint', 'minify-scripts-trans']);
});

gulp.task('default', ['watch'], function () {
    'use strict';

    console.log(
        '\n===\n You are ready to work\n===\n\n'
        + ' BEFORE COMMIT RUN TASK "gulp minify-js"\n'
    );
});

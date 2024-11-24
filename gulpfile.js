// Initialize modules
// Importing specific gulp API functions lets us write them below as series() instead of gulp.series()
const { src, dest, watch, series, parallel } = require('gulp');
// Importing all the Gulp-related packages we want to use
const sourcemaps = require('gulp-sourcemaps');
var sass = require('gulp-sass')(require('sass'));
const postcss = require('gulp-postcss');
const autoprefixer = require('autoprefixer');
const cssnano = require('cssnano');
var replace = require('gulp-replace');
var mmq = require('gulp-merge-media-queries');


// File paths
const files = { 
    scssPath: './assets/scss/**/*.scss'
}

// Sass task: compiles the style.scss file into style.css
function scssTask(){    
    return src(files.scssPath)
        .pipe(sourcemaps.init()) // initialize sourcemaps first
        .pipe(sass.sync({outputStyle: 'expanded'})) // compile SCSS to CSS
        .pipe(postcss([ autoprefixer() ])) // PostCSS plugins
        .pipe(mmq())
        .pipe(dest('./assets/css/')
    ); // put final CSS in dist folder
}

// Watch task: watch SCSS and JS files for changes
// If any change, run scss and js tasks simultaneously
function watchTask(){
    watch([files.scssPath],
        {interval: 1000, usePolling: true}, //Makes docker work
        series(
            parallel(scssTask)
        )
    );    
}

// Export the default Gulp task so it can be run
// Runs the scss and js tasks simultaneously
// then runs cacheBust, then watch task
exports.default = series(
    parallel(scssTask), 
    watchTask
);
const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */
//
// mix.js('resources/js/app.js', 'public/js')
//     .sass('resources/sass/app.scss', 'public/css');

function mix_scss_files(folder) {
    let fs = require('fs');
    let relative_path = "resources/sass" + folder;
    let paths = fs.readdirSync(relative_path);
    for (let i = 0; i < paths.length; i++) {
        if (paths[i].indexOf('.scss') > 0 && paths[i].charAt(0) != '_') {
            let file_path = relative_path + paths[i];
            mix.sass(file_path, 'public/css' + folder);
        }
    }
}

function mix_js_files(folder) {
    let fs = require('fs');
    let relative_path = "resources/js" + folder;
    let paths = fs.readdirSync(relative_path);
    for (let i = 0; i < paths.length; i++) {
        if (paths[i].indexOf('.js') > 0 && paths[i].charAt(0) != '_') {
            let file_path = relative_path + paths[i];
            mix.js(file_path, 'public/js' + folder);
        }
    }
}

mix_scss_files('/admin/')

mix_js_files('/admin/')


if (mix.inProduction()) {
    mix.version();
}

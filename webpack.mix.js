const { mix } = require('laravel-mix');

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
// mix.js('resources/assets/js/app.js', 'public/js')
//    .sass('resources/assets/sass/app.scss', 'public/css');

// CSS
mix.styles([
        'resources/assets/css/bootstrap.min.css',
        'resources/assets/css/bootstrap-datetimepicker.css',
        'resources/assets/css/font-awesome.min.css',
        'resources/assets/css/sb-admin.css'
    ],
    'public/css/all.css'
);

// Javascript
mix.js([
        'resources/assets/js/bootstrap.min.js',
        'resources/assets/js/app.js'
    ],
    'public/js');

// Big JS Files
mix.copy('resources/assets/js/jquery.min.js', 'public/js');
mix.copy('resources/assets/js/plugins/moment/moment.min.js', 'public/js');
mix.copy('resources/assets/js/plugins/datetimepicker/bootstrap-datetimepicker.js', 'public/js');

// Copy Fonts
mix.copy('resources/assets/fonts/font-awesome/', 'public/fonts');

if (mix.config.inProduction) {
    mix.version();
}
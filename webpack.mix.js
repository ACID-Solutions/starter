const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix
    .copy('resources/favicon.ico', 'public/favicon.ico')
    .copy('node_modules/@fortawesome/fontawesome-free/webfonts', 'public/fonts/fontawesome')
    .copy('resources/images', 'public/images')

    // JS **************************************************************************************************************
    // Admin
    .js('resources/js/templates/admin/library-media/index.js', 'public/js/templates/admin/library-media')
    .js('resources/js/templates/admin/library-media/edit.js', 'public/js/templates/admin/library-media')
    // Front
    .js('resources/js/templates/front/contact/page/show.js', 'public/js/templates/front/contact/page')
    // Brickables
    .js('resources/js/brickables/carousel.js', 'public/js/brickables')
    // Base
    .js('resources/js/app/admin.js', 'public/js/admin.js')
    .js('resources/js/app/front.js', 'public/js/front.js')

    // SASS ************************************************************************************************************
    // Admin
    //
    // Front
    .sass('resources/sass/templates/front/news/page/show.scss', 'public/css/templates/front/news/page')
    .sass('resources/sass/templates/front/contact/page/show.scss', 'public/css/templates/front/contact/page')
    // Brickables
    .sass('resources/sass/brickables/carousel.scss', 'public/css/brickables')
    // Base
    .sass('resources/sass/app/_admin.scss', 'public/css/admin.css')
    .sass('resources/sass/app/_front.scss', 'public/css/front.css')

    // Config **********************************************************************************************************
    .webpackConfig({
        module: {
            rules: [
                {
                    enforce: 'pre',
                    test: /\.(js)$/,
                    loader: 'eslint-loader',
                    exclude: /node_modules/
                }
            ]
        }
    })
    .options({
        processCssUrls: false,
        cssNano: {discardComments: {removeAll: true}}
    })
    .autoload({
        '@popperjs/core': ['Popper', 'window.Popper']
    })
    .extract(['@popperjs/core'])
    .sourceMaps()
    .version([
        'public/images/',
        'public/favicon.ico'
    ]);

if (mix.inProduction()) {
    mix.disableNotifications();
}

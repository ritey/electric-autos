const elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

var paths = {
	'jquery': './node_modules/jquery/',
	'bootstrap': './node_modules/bootstrap-sass/assets/',
	'fontawesome': './node_modules/font-awesome/',
	'dropzone': './node_modules/dropzone/'
}

require('laravel-elixir-vue');

elixir(mix => {

    mix.sass('app.scss', 'public/css/', null,  {

		includePaths: [

			paths.bootstrap + 'stylesheets/',

			paths.fontawesome + 'scss/'

		]

	})

		.copy(paths.bootstrap + 'fonts/bootstrap/**', 'public/fonts/bootstrap')

		.copy(paths.fontawesome + 'fonts/**', 'public/fonts/fontawesome')

		.styles([

			'public/css/app.css',

			paths.dropzone + 'dist/min/dropzone.min.css',

			'./resources/assets/css/app.css'

		], 'public/css/app.css', './')

		.scripts([

			paths.jquery + "dist/jquery.min.js",

			paths.bootstrap + "javascripts/bootstrap.min.js",

			paths.dropzone + 'dist/min/dropzone.min.js',

			'./resources/assets/js/ios9.js',
			'./resources/assets/js/app.js',

			'./resources/assets/js/**/*.js'

		], 'public/js/app.js', './')

		//.webpack('app.js')

        .version([

			'css/app.css',

			'js/app.js'

		]);

});
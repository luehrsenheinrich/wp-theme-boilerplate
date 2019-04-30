const path = require( 'path' );
const webpack = require( 'webpack' );
const UglifyJsPlugin = require( 'uglifyjs-webpack-plugin' );
const defaultConfig = require( '@wordpress/scripts/config/webpack.config' );

defaultConfig.externals = defaultConfig.externals.concat( {
	wp: 'wp',
} );

module.exports = {
	entry: {
		'script.min': path.resolve( __dirname, './build/js/script.js' ),
		'script.bundle': path.resolve( __dirname, './build/js/script.js' ),
		'font-loader.min': path.resolve( __dirname, './build/js/font-loader.js' ),
	},
	mode: 'none',
	output: {
		path: path.resolve( __dirname, './trunk' ),
		filename: '[name].js',
	},
	plugins: [
		new webpack.ProvidePlugin( {
			jQuery: 'jquery',
			$: 'jquery',
			wp: 'wp',

		} ),
		new UglifyJsPlugin( {
			include: /\.min\.js$/,
		} ),
	],
	externals: defaultConfig.externals,
	resolve: {
		modules: [
			'node_modules',
		],
	},
	module: {
		rules: [
			{
				test: /\.js$/,
				exclude: /node_modules/,
				loader: 'babel-loader',
				include: path.resolve( __dirname, 'build' ),
			},
		],
	},
};
